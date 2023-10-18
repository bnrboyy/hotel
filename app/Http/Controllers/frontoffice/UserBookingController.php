<?php

namespace App\Http\Controllers\frontoffice;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Image;

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
            DB::beginTransaction();

            $current_date = $request->checkin;
            $booking_date = "";
            for ($i = 0; $i < $request->days; $i++) {
                $booking_date .= "," . date('Y-m-d', strtotime($current_date));
                $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
            }

            $files = $request->allFiles();
            $slip_image = "";
            if (isset($files['image'])) {
                /* Upload Image */
                $newFolder = "upload/frontoffice/slip/";
                $slip_image = $this->uploadImage($newFolder, $files['image'], "newslip", "", "");
            }


            $order = new Booking();
            $order->room_id = $request->room_id;
            $order->price_per_date = $request->price_per_date;
            $order->price = $request->price;
            $order->date_checkin = date('Y-m-d', strtotime($request->checkin));
            $order->date_checkout = date('Y-m-d', strtotime($request->checkout));
            $order->booking_date = $booking_date;
            $order->days = $request->days;
            $order->status_id = 1;
            $order->booking_type = "Online";
            $order->cus_fname = $request->fname;
            $order->cus_lname = $request->lname;
            $order->cus_phone = $request->phone;
            $order->email = $request->email;
            $order->card_id = $request->card_id;
            $order->line_id = $request->line_id;
            $order->payment_type = "transfer";
            $order->slip = $slip_image;
            $order->save();

            $this->sendLineNotify($order, $room);

            DB::commit();
            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Order has been created successfully.'
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response([
                'message' => 'error',
                'status' => false,
                'errorMessage' => $e->getMessage()
            ], 500);
        }
    }
}
