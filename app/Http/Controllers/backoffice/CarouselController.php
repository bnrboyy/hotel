<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CarouselController extends Controller
{
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'priority' => 'required',
            'display' => 'required',
            'image' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        $files = $request->allFiles();
        $image = "";

        if (isset($files['image'])) {
            /* Upload Image */
            $newFolder = "upload/backoffice/carousel/";
            $image = $this->uploadImage($newFolder, $files['image'], "newcarousel", "", "");
        }

        try {

            $newData = Carousel::create([
                'image' => $image,
                'priority' => (int)$request->priority,
                'display' => (int)$request->display,
            ]);

            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Carousel has been created successfully.',
                'data' => $newData,
            ], 201);
        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'status' => false,
                'errorMessage' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $carousel = Carousel::where(['id' => $request->id])->get()->first();

            /* Delete file. */
            if (file_exists($carousel->image)) {
                File::delete($carousel->image);
            }

            $carousel->delete();

            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Carousel has been deleted successfully.'
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'status' => false,
                'errorMessage' => $e->getMessage()
            ], 500);
        }
    }

    public function getById(Request $request)
    {
        try {

            $carousel = Carousel::where(['id' => $request->id])->get()->first();

            if (!$carousel) {
                return response([
                    'message' => 'error',
                    'status' => false,
                    'description' => 'Carousel not found!.'
                ], 404);
            }

            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Get carousel success.',
                'data' => $carousel,
            ], 200);
        } catch (Exception $e) {

            return response([
                'message' => 'error',
                'status' => false,
                'errorMessage' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'carousel_id' => 'required',
            'priority' => 'required',
            'display' => 'required',
            'image' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        $files = $request->allFiles();
        $image = "";

        if (isset($files['image'])) {
            /* Upload Image */
            $newFolder = "upload/backoffice/carousel/";
            $image = $this->uploadImage($newFolder, $files['image'], "carousel", "", "");
        }

        try {
            DB::beginTransaction();

            $carousel = Carousel::find($request->carousel_id);

            if (!$carousel) {
                return response([
                    'message' => 'error',
                    'status' => false,
                    'description' => 'Carousel not found!.'
                ], 404);
            }

            if (isset($files['image'])) $carousel->image = $image;

            $carousel->display = (int)$request->display;
            $carousel->priority = (int)$request->priority;
            $carousel->save();

            DB::commit();
            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Carousel has been updated successfully.',
                'data' => $carousel,
            ], 200);
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
