<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Booking;
use App\Models\Carousel;
use App\Models\Contact;
use App\Models\Facilitie;
use App\Models\Feature;
use App\Models\Gallery;
use App\Models\Room;
use App\Models\TempBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    public function getHome(Request $request)
    {
        $this->removeTempBooking();
        $facilities = Facilitie::where(['display' => 1])->orderBy('priority', 'ASC')->limit(5)->get();
        $carousel = Carousel::where(['display' => 1])->orderBy('priority', 'ASC')->get()->all();

        $rooms = Room::where(['display' => 1])->orderBy('price', 'ASC')->limit(3)->get();

        foreach ($rooms as $room) {
            $fea_ids = explode(', ', $room->feature_ids); // "1,2,3,4" => [1,2,3,4]
            $fac_ids = explode(', ', $room->fac_ids); // "1,2,3,4" => [1,2,3,4]

            $contactUs = Contact::get()->first();
            $features = Feature::whereIn('id', $fea_ids)->orderBy('priority', 'ASC')->get();
            $facs = Facilitie::whereIn('id', $fac_ids)->orderBy('priority', 'ASC')->get();
            $gallery = $room->gallery;
            // $gallery = Gallery::where('room_id', $room->id)->orderBy('default', 'DESC')->get();

            $room->features = $features;
            $room->facs = $facs;
            $room->gallery = $gallery;
        }

        return view('frontoffice.home', [
            'slide_img' => $carousel,
            'facilities' => $facilities,
            'rooms' => $rooms,
            'contactUs' => $contactUs,
            'temp_id' => session('temp_id'),
        ]);
    }

    public function facilitiesPage(Request $request)
    {
        $this->removeTempBooking();
        $facilities = Facilitie::where(['display' => 1])->orderBy('priority', 'ASC')->get();

        return view('frontoffice.facilities', [
            'facilities' => $facilities,
            'temp_id' => session('temp_id'),

        ]);
    }

    public function aboutPage(Request $request)
    {
        $this->removeTempBooking();
        return view('frontoffice.about');
    }

    public function contactPage(Request $request)
    {
        $this->removeTempBooking();
        $contact_settings = Contact::where(['id' => 1])->get()->first();

        return view('frontoffice.contactus', [
            'contact' => $contact_settings,
            'temp_id' => session('temp_id'),
        ]);
    }

    public function roomPage(Request $request)
    {
        $this->removeTempBooking();

        $validator = Validator::make($request->all(), [
            'checkin' => 'string|required',
            'checkout' => 'string|required',
            'adult' => 'numeric|required',
            'children' => 'numeric|required',
        ]);

        $current_timestamp = strtotime(date('Y-m-d'));
        $checkin_timestamp = strtotime($request->checkin);
        $checkout_timestamp = strtotime($request->checkout);

        if (($checkin_timestamp !== false && $checkin_timestamp < $current_timestamp) || ($checkout_timestamp !== false && $checkout_timestamp < $checkin_timestamp) || ($checkin_timestamp !== false && $checkin_timestamp === $checkout_timestamp)) {
            return view('frontoffice.rooms', [
                'rooms' => [],
                'temp_id' => session('temp_id'),
            ]);
        }

        $now = Carbon::now(); // วันเวลาปัจจุบัน
        $tempLimit = $now->subMinutes(16); // ลบไป 16 นาที

        $tempBooking = TempBooking::where('created_at', '>', $tempLimit)->get(); // temp booking ที่ล็อกไว้ให้ชำละเงิน
        $rooms = Room::where(['display' => 1])->orderBy('price', 'ASC')->get();
        $roomAvailable = $rooms;

        foreach ($rooms as $room) {
            $fea_ids = explode(', ', $room->feature_ids);
            $fac_ids = explode(', ', $room->fac_ids);

            $features = Feature::whereIn('id', $fea_ids)->orderBy('priority', 'ASC')->get();
            $facs = Facilitie::whereIn('id', $fac_ids)->orderBy('priority', 'ASC')->get();
            $gallery = $room->gallery;

            $room->features = $features;
            $room->facs = $facs;
            $room->gallery = $gallery;
        }

        if (!$validator->fails()) {
            // หาจำนวนคืนที่เข้าพัก
            $start_date = $request->checkin; // 2023-12-14
            $end_date = $request->checkout; // 2023-12-15
            $start_timeStamp = strtotime($start_date); //17474834834
            $end_timeStamp = strtotime($end_date); //17474834834
            $secondsDiff = $end_timeStamp - $start_timeStamp; // ผลต่างที่เป็นวินาที
            $diff_date = $secondsDiff / (60 * 60 * 24); // ได้จำนวนวัน

            $bookings = DB::table('bookings') // หาการจอง
                ->select('bookings.*')
                ->where(function ($query) use ($request, $diff_date) {
                    $current_date = $request->checkin; // เริ่ม 2023-12-14
                    for ($i = 0; $i < $diff_date; $i++) {
                        $query->orWhere('booking_date', 'like', '%' . $current_date . '%');
                        $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
                    }
                })
                ->whereIn('status_id', [1, 2, 3])
                ->get();

            /* กรองห้องว่าง */
            if (count($bookings) > 0) { // ถ้ามี booking ซ้ำ เอาห้องที่ตรงกันออก
                foreach ($bookings as $book_key => $book_value) {
                    foreach ($rooms as $room_key => $room_value) {
                        if (($room_value->id === $book_value->room_id) || ($room_value->adult < $request->adult || $room_value->children < $request->children)) {
                            unset($roomAvailable[$room_key]);
                        }
                    }
                }
            } else { // ถ้ามี booking ไม่ซ้ำ กรองจำนวนผู้เข้าพัก
                foreach ($rooms as $room_key => $room_value) {
                    if (($room_value->adult < $request->adult || $room_value->children < $request->children)) {
                        unset($roomAvailable[$room_key]);
                    }
                }
            }

            /* กรองห้องที่กำลังจะชำละเงินภายใน 15 นาที */
            if (count($tempBooking) > 0) { // temp booking
                $roomTemp_ids = [];

                foreach ($tempBooking as $temp) {
                    $current_date = $request->checkin;
                    for ($i = 0; $i < $diff_date; $i++) {
                        if (Str::contains($temp->booking_date, $current_date)) { // เปรียบเทียบ String
                            $roomTemp_ids[] = $temp->room_id; // [1,2,3]
                        }
                        $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
                    }
                }

                if (count($roomTemp_ids) > 0) {
                    foreach ($roomTemp_ids as $id_key => $id) {
                        foreach ($roomAvailable as $room_key => $room_value) {
                            if ($id === $room_value->id) {
                                unset($roomAvailable[$room_key]);
                            }
                        }
                    }
                }
            }
        }

        return view('frontoffice.rooms', [
            'rooms' => $roomAvailable,
            'temp_id' => session('temp_id'),
        ]);
    }

    public function roomDetailsPage(Request $request)
    {
        $this->removeTempBooking();

        $validator = Validator::make($request->all(), [
            'checkin' => 'string|required',
            'checkout' => 'string|required',
        ]);

        $room = Room::where(['id' => $request->id])->first();

        if (!$room) {
            return redirect()->back();
        }

        $fea_ids = explode(', ', $room->feature_ids);
        $fac_ids = explode(', ', $room->fac_ids);
        $features = Feature::whereIn('id', $fea_ids)->orderBy('priority', 'ASC')->get();
        $facs = Facilitie::whereIn('id', $fac_ids)->orderBy('priority', 'ASC')->get();
        $gallery = $room->gallery;

        $room->features = $features;
        $room->facs = $facs;
        $room->gallery = $gallery;
        $isAvailable = true;

        if ($validator->fails()) {
            return view('frontoffice.room-details', [
                'room' => $room,
                'isAvailable' => false,
                'details_only' => true,
                'temp_id' => session('temp_id'),
            ]);
        }

        $current_timestamp = strtotime(date('Y-m-d'));
        $checkin_timestamp = strtotime($request->checkin);
        $checkout_timestamp = strtotime($request->checkout);

        $now = Carbon::now();
        $tempLimit = $now->subMinutes(16);
        $tempBooking = TempBooking::where('created_at', '>', $tempLimit)->where('room_id', $request->id)->get(); // temp booking ที่ล็อกไว้ให้ชำละเงิน

        if (($checkin_timestamp !== false && $checkin_timestamp < $current_timestamp) || ($checkout_timestamp !== false && $checkout_timestamp < $checkin_timestamp) || ($checkin_timestamp !== false && $checkin_timestamp === $checkout_timestamp)) {
            return view('frontoffice.room-details', [
                'room' => $room,
                'isAvailable' => false,
                'details_only' => false,
                'temp_id' => session('temp_id'),
            ]);
        }

        // หาจำนวนคืนที่เข้าพัก
        $start_date = $request->checkin;
        $end_date = $request->checkout;
        $start_timeStamp = strtotime($start_date);
        $end_timeStamp = strtotime($end_date);
        $secondsDiff = $end_timeStamp - $start_timeStamp;
        $diff_date = $secondsDiff / (60 * 60 * 24);

        $bookings = DB::table('bookings')
            ->select('bookings.*')
            ->where(function ($query) use ($request, $diff_date) {
                $current_date = $request->checkin;
                for ($i = 0; $i < $diff_date; $i++) {
                    $query->orWhere('booking_date', 'like', '%' . $current_date . '%');
                    $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
                }
            })
            ->whereIn('status_id', [1, 2, 3])
            ->get();
        if (count($bookings) > 0) {
            foreach ($bookings as $book_key => $book_value) {
                if ($book_value->room_id === $room->id) {
                    $isAvailable = false;
                }
            }
        } else {
            $isAvailable = true;
        }

        if (count($tempBooking) > 0) { // เช็ค temp booking
            foreach ($tempBooking as $temp) {
                $current_date = $request->checkin;
                for ($i = 0; $i < $diff_date; $i++) {
                    if (Str::contains($temp->booking_date, $current_date)) { // เปรียบเทียบ String
                        $isAvailable = false;
                    }
                    $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
                }
            }
        }

        return view('frontoffice.room-details', [
            'room' => $room,
            'isAvailable' => $isAvailable,
            'details_only' => false,
            'temp_id' => session('temp_id'),
        ]);
    }

    public function bookingDetailsPage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'checkin' => 'string|required',
            'checkout' => 'string|required',
            'id' => 'numeric|required',
        ]);

        $now = Carbon::now();
        $tempLimit = $now->subMinutes(16);
        $tempBooking = TempBooking::where('created_at', '>', $tempLimit)->where('room_id', $request->id)->get(); // temp booking ที่ล็อกไว้ให้ชำละเงิน

        if ((count($tempBooking) > 0 && !session()->has('temp_id'))) {
            // หาจำนวนคืนที่เข้าพัก
            $start_date = $request->checkin;
            $end_date = $request->checkout;
            $start_timeStamp = strtotime($start_date);
            $end_timeStamp = strtotime($end_date);
            $secondsDiff = $end_timeStamp - $start_timeStamp;
            $diff_date = $secondsDiff / (60 * 60 * 24);
            $isAvailable = true;

            foreach ($tempBooking as $temp) {
                $current_date = $request->checkin;
                for ($i = 0; $i < $diff_date; $i++) {
                    if (Str::contains($temp->booking_date, $current_date)) { // เปรียบเทียบ String
                        $isAvailable = false;
                    }
                    $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
                }
            }

            if (!$isAvailable) {
                $this->removeTempBooking();
                return redirect()->route('rooms'); // กลับไปที่หน้า Rooms
            }
        }

        $current_timestamp = strtotime(date('Y-m-d'));
        $checkin_timestamp = strtotime($request->checkin);
        $checkout_timestamp = strtotime($request->checkout);

        if ($validator->fails() || (($checkin_timestamp !== false && $checkin_timestamp < $current_timestamp) || ($checkout_timestamp !== false && $checkout_timestamp < $checkin_timestamp) || ($checkin_timestamp !== false && $checkin_timestamp === $checkout_timestamp))) {
            return redirect()->route('rooms'); // กลับไปที่หน้า Rooms
        }

        $room = Room::where(['id' => $request->id])->first();

        if (!$room) {
            return redirect()->route('rooms'); // กลับไปที่หน้า Rooms
        }

        $fea_ids = explode(', ', $room->feature_ids);
        $fac_ids = explode(', ', $room->fac_ids);
        $features = Feature::whereIn('id', $fea_ids)->orderBy('priority', 'ASC')->get();
        $facs = Facilitie::whereIn('id', $fac_ids)->orderBy('priority', 'ASC')->get();

        $room->features = $features;
        $room->facs = $facs;


        // หาจำนวนคืนที่เข้าพัก
        $start_date = $request->checkin;
        $end_date = $request->checkout;
        $secondsDiff = strtotime($end_date) - strtotime($start_date);
        $diff_date = $secondsDiff / (60 * 60 * 24);

        $isAvailable = $this->checkAvailableRoom($request, $room);

        $bank_details = Bank::where(['display' => 1])->orderBy('priority', 'ASC')->first();

        if (!$bank_details) {
            $bank_details = Bank::orderBy('priority', 'ASC')->first();
        }

        // สร้าง temp booking
        $this->createTempBooking($request);

        return view('frontoffice.booking-details', [
            'room' => $room,
            'checkin' => date('d-m-Y', strtotime($request->checkin)),
            'checkout' => date('d-m-Y', strtotime($request->checkout)),
            'diff_date' => $diff_date,
            'isAvailable' => $isAvailable,
            'bank_details' => $bank_details,
            'temp_id' => session('temp_id'),
        ]);
    }

    public function bookingSearchPage(Request $request)
    {
        $this->removeTempBooking();
        $validator = Validator::make($request->all(), [
            'phone' => 'numeric|required',
            'card_id' => 'numeric|required',
        ]);

        if ($validator->fails()) {
            return view('frontoffice.booking-search', [
                'bookings' => [],
                'temp_id' => session('temp_id'),
            ]);
        }

        $bookings = Booking::join('booking_statuses', 'booking_statuses.id', '=', 'bookings.status_id')
            ->join('rooms', 'rooms.id', '=', 'bookings.room_id')
            ->where(['cus_phone' => $request->phone, 'card_id' => $request->card_id])
            ->select('bookings.*', 'booking_statuses.name AS status_name', 'booking_statuses.bg_color AS bg_color', 'rooms.name AS room_title')
            ->orderBy('bookings.status_id', 'ASC')
            ->orderBy('bookings.booking_number', 'DESC')
            ->get();

        // dd($bookings);

        return view('frontoffice.booking-search', [
            'bookings' => $bookings,
            'temp_id' => session('temp_id'),
        ]);
    }


    /* Private Function */
    private function createTempBooking(Request $request)
    {
        // session()->forget('temp_id');

        if (!session()->has('temp_id')) {
            $temp_id = 'Temp-' . str_shuffle(time()); // random temp_id

            // หาจำนวนคืนที่เข้าพัก
            $start_date = $request->checkin;
            $end_date = $request->checkout;
            $secondsDiff = strtotime($end_date) - strtotime($start_date);
            $diff_date = $secondsDiff / (60 * 60 * 24);

            $current_date = $request->checkin;
            $booking_date = "";
            for ($i = 0; $i < $diff_date; $i++) {
                $booking_date .= "," . date('Y-m-d', strtotime($current_date));
                $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
            }

            // dd(session('temp_id'));
            $TempBooking = new TempBooking();
            $TempBooking->temp_id = $temp_id;
            $TempBooking->room_id = $request->id;
            $TempBooking->ip_address = $request->ip();
            $TempBooking->date_checkin = date('Y-m-d', strtotime($request->checkin));
            $TempBooking->date_checkout = date('Y-m-d', strtotime($request->checkout));
            $TempBooking->booking_date = $booking_date;
            $TempBooking->days = $diff_date;
            $TempBooking->booking_type = 'Online';
            $TempBooking->save();

            session(['temp_id' => $temp_id]);
            session()->put('tempId_timeout', now()->addMinutes(20));
        }
    }
}
