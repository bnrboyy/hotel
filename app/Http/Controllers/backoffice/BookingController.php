<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingStatus;
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
}
