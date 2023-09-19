<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
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
}
