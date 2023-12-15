<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\TempBooking;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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

        $now = Carbon::now(); // วันเวลาปัจจุบัน
        $tempLimit = $now->subMinutes(16); // ลบไป 16 นาที
        $tempBooking = TempBooking::where('created_at', '>', $tempLimit)->get(); // temp booking ที่ล็อกไว้ให้ชำละเงิน

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


        /* กรองห้องที่กำลังจะชำละเงินภายใน 15 นาที */
        if (count($tempBooking) > 0) { // temp booking
            foreach ($tempBooking as $temp) {
                $current_date = $request->checkin;
                for ($i = 0; $i < $diff_date; $i++) {
                    if (Str::contains($temp->booking_date, $current_date) && $temp->room_id === $room->id && $temp->temp_id !== session('temp_id')) { // เปรียบเทียบ String
                        $isAvailable = false;
                    }
                    $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
                }
            }
        }

        return $isAvailable;
    }

    public function sendLineNotify(Booking $booking, Room $room)
    {
        // dd($booking);
        $message = "👇👇 มีรายการจองห้องพักใหม่ 👇👇 \n\n"
            . "No. ►► " . $booking->booking_number . "\n"
            . "เลขอ้างอิงการจอง ►► " . $booking->card_id . "\n"
            . "ประเภทการจอง ►► " . "【 Online 】" . "\n"
            // . "สถานะ ►► " . "รอการตรวจสอบ" . "\n"
            . "ชื่อ-นามสกุล ผู้จอง ►► " . $booking->cus_fname . " " . $booking->cus_lname . "\n"
            . "เบอร์โทร ►► " . $booking->cus_phone . "\n"
            . "ห้องพัก ►► " . $room->name . "\n"
            . "เช็คอิน ►► " . $booking->date_checkin . "\n"
            . "เช็คเอาท์ ►► " . $booking->date_checkout . "\n"
            . "ระยะเวลาเข้าพัก ►► " . $booking->days . ' วัน' . "\n"
            . "ราคารวม ►► " . $booking->price . ' บาท' . "\n";

        $LINE_API = "https://notify-api.line.me/api/notify";
        $LINE_TOKEN = "dVyvQN5pvqOLLOna8JDTck2rvI43Dr4vfP4rcddMETr";
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Authorization: Bearer " . $LINE_TOKEN . "\r\n"
                    . "Content-Length: " . strlen($queryData) . "\r\n",
                'content' => $queryData
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents($LINE_API, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }

    public function removeTempBooking()
    {
        if (session()->has('temp_id')) {
            TempBooking::where('temp_id', session('temp_id'))->delete();
            session()->forget('temp_id');
        }
    }
}
