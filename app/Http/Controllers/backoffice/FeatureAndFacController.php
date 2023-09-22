<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\Facilitie;
use App\Models\Feature;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FeatureAndFacController extends Controller
{
    public function createFeature(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'priority' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        try {
            $newData = Feature::create([
                'name' => $request->name,
                'priority' => (int)$request->priority,
                'display' => true,
            ]);

            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Feature has been created successfully.',
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

    public function getFeatureById(Request $request, $id)
    {
        try {
            $feature = Feature::where(['id' => $id])->get()->first();

            if (!$feature) {
                return response([
                    'message' => 'error',
                    'status' => false,
                    'description' => 'Feature not found!.'
                ], 404);
            }

            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Get carousel success.',
                'data' => $feature,
            ], 200);
        } catch (Exception $e) {

            return response([
                'message' => 'error',
                'status' => false,
                'errorMessage' => $e->getMessage()
            ], 500);
        }
    }

    public function updateFeature(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'priority' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        try {
            DB::beginTransaction();

            $data = $request->all();
            $feature = Feature::find($request->id);

            if (!$feature) {
                return response()->json(['message' => 'Feature not found'], 404);
            }

            $feature->update($data);

            DB::commit();
            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Feature has been updated successfully.'
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

    public function updateFacDisplay(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->only(['display']);
            $facUpdate = Facilitie::find($id);

            if (!$facUpdate) {
                return response()->json(['message' => 'Facilitie not found'], 404);
            }

            $facUpdate->update($data);

            DB::commit();
            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Facilities display has been updated successfully.'
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

    public function updateFeatureDisplay(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->only(['display']);
            $feature = Feature::find($id);

            if (!$feature) {
                return response()->json(['message' => 'Feature not found'], 404);
            }

            $feature->update($data);

            DB::commit();
            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Feature display has been updated successfully.'
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

    public function deleteFac(Request $request, $id)
    {
        $facilities = Facilitie::where('id', $id)->delete();

        return response([
            'message' => 'ok',
            'status' => true,
            'description' => "Facilitie has been deleted successfully.",
        ], 200);
    }

    public function deleteFeature(Request $request, $id)
    {
        $feature = Feature::where('id', $id)->delete();

        return response([
            'message' => 'ok',
            'status' => true,
            'description' => "Feature has been deleted successfully.",
        ], 200);
    }
}
