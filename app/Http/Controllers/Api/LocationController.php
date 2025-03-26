<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Exception;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index($id = null){

        if($id!=null){
            $loc = Location::find($id);
            if(!$loc)
            {
                return response()->json([
                    'message' => 'Employee not found'
                ], 404);
            }
            return response()->json([
                'message'=>"Particular Data",
                'data'=>$loc
            ]);

        }else{
            $loc = Location::all();
            return response()->json([
            'message'=>"Whole List",
            'data'=> $loc
            ]);
        }

        
    }
    
    public function create(Request $request)
    {
        try {
            // Create a new admin
            $location = Location::create([
                'locationName' =>  $request->locationName,
                'shortName'  =>  $request->shortName,
                'created_by' =>  $request->created_by,
                'updated_by' =>  $request->created_by,
            ]);

            return response()->json([
                'message' => "Location Created Successfully",
                'data'   => $location,
                'status' => true
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => "Something went wrong",
                'error' => $e->getMessage(),
                'status' => false
            ], 500); 
        }
    }

    public function update(Request $request, $id = null)
    {
        try {
            if (!$id) {
                return response()->json([
                    'message' => "Location ID is required",
                    'status' => false
                ], 400); 
            }

            $location = Location::find($id);

            // Update admin details
            $location->update([
                'locationName' => $request->locationName ?? $location->locationName,
                'shortName' => $request->shortName ?? $location->shortName,
                'updated_by' => $request->updated_by ?? $location->updated_by,
                'created_by' => $request->created_by ?? $location->created_by
            ]);

            return response()->json([
                'message' => "Location {$id} Updated Successfully",
                'data' => $location
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Something went wrong",
                'error' => $e->getMessage(),
                'status' => false
            ], 500); 
        }
    }

    public function delete(Request $request, $id = null){
        if($id!=null){
            return response()->json([
                'message'=>"Location {$id} Deleted Successfully",
            ]);
        }else{
            return response()->json([
                'message'=>"Select any for Delete",
            ]);
        }
    }
}
