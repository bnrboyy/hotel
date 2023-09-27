<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function createRoom(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'price' => 'numeric|required',
            'adult' => 'numeric|required',
            'children' => 'numeric|required',
            'area' => 'numeric|required',
            'description' => 'string|nullable',
            'feature_ids' => 'array|required',
            'fac_ids' => 'array|required',
        ]);

        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        $feature_ids = implode(', ', $request->feature_ids);
        $fac_ids = implode(', ', $request->fac_ids);

        try {
            $newData = Room::create([
                'name' => $request->name,
                'price' => (int)$request->price,
                'adult' => (int)$request->adult,
                'children' => (int)$request->children,
                'area' => $request->area,
                'description' => $request->description,
                'feature_ids' => $feature_ids,
                'fac_ids' => $fac_ids,
                'display' => true,
            ]);

            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Room has been created successfully.',
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

    public function getRoomById(Request $request, $id)
    {
        try {
            $room = Room::where(['id' => $id])->get()->first();

            $feature_ids = explode(', ', $room->feature_ids);
            $fac_ids = explode(', ', $room->fac_ids);

            $room->feature_ids = $feature_ids;
            $room->fac_ids = $fac_ids;

            if (!$room) {
                return response([
                    'message' => 'error',
                    'status' => false,
                    'description' => 'Room not found!.'
                ], 404);
            }

            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Get room success.',
                'data' => $room,
            ], 200);
        } catch (Exception $e) {

            return response([
                'message' => 'error',
                'status' => false,
                'errorMessage' => $e->getMessage()
            ], 500);
        }
    }

    public function updateRoom(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'numeric|required',
            'name' => 'string|required',
            'price' => 'numeric|required',
            'adult' => 'numeric|required',
            'children' => 'numeric|required',
            'area' => 'numeric|required',
            'description' => 'string|nullable',
            'feature_ids' => 'array|required',
            'fac_ids' => 'array|required',
        ]);

        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        $feature_ids = implode(', ', $request->feature_ids);
        $fac_ids = implode(', ', $request->fac_ids);

        try {
            DB::beginTransaction();

            $room = Room::where(['id' => $request->room_id])->first();

            if (!$room) {
                return response([
                    'message' => 'error',
                    'status' => false,
                    'description' => 'Room not found!.'
                ], 404);
            }

            $room->name = $request->name;
            $room->price = $request->price;
            $room->adult = $request->adult;
            $room->children = $request->children;
            $room->description = $request->description;
            $room->area = $request->area;
            $room->feature_ids = $feature_ids;
            $room->fac_ids = $fac_ids;
            $room->save();

            DB::commit();
            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Room has been updated successfully.',
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

    public function updateRoomDisplay(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->only(['display']);
            $roomUpdate = Room::find($id);

            if (!$roomUpdate) {
                return response()->json(['message' => 'Room not found'], 404);
            }

            $roomUpdate->update($data);

            DB::commit();
            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Room display has been updated successfully.'
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
