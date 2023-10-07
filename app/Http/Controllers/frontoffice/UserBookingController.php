<?php

namespace App\Http\Controllers\frontoffice;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserBookingController extends Controller
{
    public function createBookOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "image" => "image|required|mimes:jpeg,png,jpg",
            "fname" => "string|required",
            "lname" => "string|required",
            "phone" => "string|required",
            "email" => "email|required",
            "card_id" => "numeric|required",
            "line_id" => "string|nullable",
            "checkin" => "string|required",
            "checkout" => "string|required",
            "room_id" => "numeric|required",
        ]);

        if ($validator->fails()) {
            return response([
                'message' => 'error',
                'status' => false,
                'errorMessage' => 'Invalid params!'
            ], 404);
        }

        $room = Room::where(['id' => $request->room_id])->first();

        $isAvailable = $this->checkAvailableRoom($request, $room);

        if (!$isAvailable) {
            return response([
                'message' => 'error',
                'status' => false,
                'errorMessage' => 'This room is not available!',
                'isAvailable' => $isAvailable,
            ], 403);
        }

        try {

            $order = new Booking();
            $order->booking_id = 'BK-' . $request->card_id;
            $order->room_id = $request->room_id;

            $order->save();

            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Order has been created successfully.'
            ], 201);
        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'status' => false,
                'errorMessage' => $e->getMessage()
            ], 500);
        }
    }
}
