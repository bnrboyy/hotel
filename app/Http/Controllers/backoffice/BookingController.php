<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Booking;
use App\Models\BookingStatus;
use App\Models\Facilitie;
use App\Models\Feature;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function updatebookingStatus(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'booking_id' => 'numeric|required',
                'status_id' => 'numeric|required',
            ]);

            if ($validator->fails()) {
                return $this->sendErrorValidators('Invalid params', $validator->errors());
            }

            $dataUpdate = $request->only(['status_id']);
            Booking::where('id', $request->booking_id)->update($dataUpdate);

            $booking = Booking::where('id', $request->booking_id)->first();
            $status = BookingStatus::where('id', $request->status_id)->first();

            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Booking status has been updated successfully.',
                'booking' => $booking,
                'booking_status' => $status,
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'status' => false,
                'errorMessage' => $e->getMessage()
            ], 500);
        }
    }

    public function getBookingById(Request $request, $id)
    {
        try {
            $booking = Booking::join('booking_statuses AS bs', 'bs.id', 'bookings.status_id')
                ->join('rooms', 'rooms.id', 'bookings.room_id')
                ->select('bookings.*', 'rooms.name AS room_name', 'bs.name AS status_name', 'bs.bg_color AS bg_color')
                ->where('bookings.id', $id)
                ->orderBy('bookings.created_at', 'DESC')
                ->get();

            if (!$booking) {
                return response([
                    'message' => 'error',
                    'status' => false,
                    'description' => "Booking not found!",
                ], 404);
            }

            $book = $booking[0];

            $formBook = [
                $book->booking_number,
                $book->card_id,
                $book->room_name,
                $book->date_checkin,
                $book->date_checkout,
                $book->days,
                $book->price,
                date($book->created_at),
                $book->status_name,
                $book->cus_fname . ' ' . $book->cus_lname,
                $book->email,
                $book->line_id,
                $book->payment_type === "transfer" ? "โอนจ่าย" : "เงินสด",
                $book->booking_type,
            ];

            return response([
                'message' => 'ok',
                'status' => true,
                'description' => "Get Booking by ID success",
                'data' => [
                    'formData' => $formBook,
                    'booking' => $book,
                ],
            ], 200);

            // dd($booking);

            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Get booking success.',
                'data' => $booking[0],
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'status' => false,
                'errorMessage' => $e->getMessage()
            ], 500);
        }
    }

    public function preBooking(Request $request)
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
            return response([
                'message' => 'Invalid params'
            ], 401);
        }

        $room = Room::where(['id' => $request->id])->first();

        if (!$room) {
            return response([
                'message' => 'room not found'
            ], 200);
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

        $preText = [
            'Check-in :' . date('d-m-Y', strtotime($request->checkin)),
            'Check-out :' . date('d-m-Y', strtotime($request->checkout)),
            'Day :' . $diff_date . 'วัน',
            'Price :' . $room->price * $diff_date . '฿',
        ];

        return response([
            'room' => $room,
            'checkin' => date('d-m-Y', strtotime($request->checkin)),
            'checkout' => date('d-m-Y', strtotime($request->checkout)),
            'diff_date' => $diff_date,
            'isAvailable' => $isAvailable,
        ], 200);
    }
}
