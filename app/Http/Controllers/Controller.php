<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendErrorValidators($message, $errorMessages)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errorMessage' => $errorMessages
        ], 422);
    }

    public function uploadImage($folderPath = "upload/", $image = NULL, $preName = "", $postName = "", $customName = NULL)
    {
        if ($image) {
            /* Checking folder */
            if (!file_exists($folderPath)) {
                File::makeDirectory($folderPath, $mode = 0777, true, true);
            }
            $extName = "." . $image->extension();
            $name = ($customName !== NULL) ? str_replace($extName, "", $customName) : time();
            $fullName = $preName . $name . $postName;
            $newImageName = $fullName . $extName;
            if (file_exists($folderPath . $newImageName)) {
                for ($ii = 1; true; $ii++) {
                    $editNameDuplicate = $fullName . "({$ii})" . $extName;
                    if (!file_exists($folderPath . $editNameDuplicate)) {
                        $newImageName = $editNameDuplicate;
                        break;
                    }
                }
            }
            if ($image->move($folderPath, $newImageName)) {
                return $folderPath . $newImageName;
            }
        }
        return false;
    }

    public function checkAvailableRoom($request, $room)
    {
        // หาจำนวนคืนที่เข้าพัก
        $start_date = $request->checkin;
        $end_date = $request->checkout;
        $start_timeStamp = strtotime($start_date);
        $end_timeStamp = strtotime($end_date);
        $secondsDiff = $end_timeStamp - $start_timeStamp;
        $diff_date = $secondsDiff / (60 * 60 * 24);
        $isAvailable = true;

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
        }

        return $isAvailable;
    }
}
