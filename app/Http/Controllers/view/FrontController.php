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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function getHome(Request $request)
    {
        $this->removeTempBooking();
        $facilities = Facilitie::where(['display' => 1])->orderBy('priority', 'ASC')->limit(5)->get();
        $carousel = Carousel::where(['display' => 1])->orderBy('priority', 'ASC')->get()->all();

        $rooms = Room::where(['display' => 1])->orderBy('price', 'ASC')->limit(3)->get();

        foreach ($rooms as $room) {
            $fea_ids = explode(', ', $room->feature_ids);
            $fac_ids = explode(', ', $room->fac_ids);

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
        ]);
    }

    public function facilitiesPage(Request $request)
    {
        $this->removeTempBooking();
        $facilities = Facilitie::where(['display' => 1])->orderBy('priority', 'ASC')->get();

        return view('frontoffice.facilities', [
            'facilities' => $facilities,

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

        return view('frontoffice.contactus', ['contact' => $contact_settings]);
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
            ]);
        }

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
                    // $room_ids[] = $book_value->room_id;
                    foreach ($rooms as $room_key => $room_value) {
                        if (($room_value->id === $book_value->room_id) || ($room_value->adult < $request->adult || $room_value->children < $request->children)) {
                            unset($roomAvailable[$room_key]);
                        }
                    }
                }
            } else { // กรองจำนวนผู้เข้าพัก
                foreach ($rooms as $room_key => $room_value) {
                    if (($room_value->adult < $request->adult || $room_value->children < $request->children)) {
                        unset($roomAvailable[$room_key]);
                    }
                }
            }
        }

        return view('frontoffice.rooms', [
            'rooms' => $roomAvailable,
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
        // $gallery = Gallery::where('room_id', $room->id)->orderBy('default', 'DESC')->get();

        $room->features = $features;
        $room->facs = $facs;
        $room->gallery = $gallery;
        $isAvailable = true;

        if ($validator->fails()) {
            return view('frontoffice.room-details', [
                'room' => $room,
                'isAvailable' => false,
                'details_only' => true,
            ]);
        }

        $current_timestamp = strtotime(date('Y-m-d'));
        $checkin_timestamp = strtotime($request->checkin);
        $checkout_timestamp = strtotime($request->checkout);

        if (($checkin_timestamp !== false && $checkin_timestamp < $current_timestamp) || ($checkout_timestamp !== false && $checkout_timestamp < $checkin_timestamp) || ($checkin_timestamp !== false && $checkin_timestamp === $checkout_timestamp)) {
            return view('frontoffice.room-details', [
                'room' => $room,
                'isAvailable' => false,
                'details_only' => false,
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

        return view('frontoffice.room-details', [
            'room' => $room,
            'isAvailable' => $isAvailable,
            'details_only' => false,
        ]);
    }

    public function bookingDetailsPage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'checkin' => 'string|required',
            'checkout' => 'string|required',
            'id' => 'numeric|required',
        ]);

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
            'bookings' => $bookings
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
        }
    }

    private function removeTempBooking()
    {
        if (session()->has('temp_id')) {
            TempBooking::where('temp_id', session('temp_id'))->delete();
        }
    }
}
