<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index($id = null){

        if($id!=null){

            return response()->json([
                'message'=>"Particular Data",
                'data'=>$id
            ]);

        }else{
            return response()->json([
                'message'=>"Whole List",
                'data'=>"Your Data"
            ]);
        }

        
    }
    
    public function create(Request $request){

        return response()->json([
            'message'=>"Employee Created Successfully"
        ]);

    }

    public function update(Request $request, $id = null){

        if($id!=null){
            return response()->json([
                'message'=>"Employee {$id} Updated Successfully",
                'data'=>$id
            ]);
        }else{
            return response()->json([
                'message'=>"Select any for update",
            ]);
        }
        
    }

    public function delete(Request $request, $id = null){
        if($id!=null){
            return response()->json([
                'message'=>"Employee {$id} Deleted Successfully",
            ]);
        }else{
            return response()->json([
                'message'=>"Select any for Delete",
            ]);
        }
    }
}
