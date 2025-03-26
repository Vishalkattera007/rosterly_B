<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    //

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
            'message'=>"Admin Created Successfully"
        ]);

    }

    public function update(Request $request, $id = null){

        if($id!=null){
            return response()->json([
                'message'=>"Admin {$id} Updated Successfully",
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
                'message'=>"Admin {$id} Deleted Successfully",
            ]);
        }else{
            return response()->json([
                'message'=>"Select any for Delete",
            ]);
        }
    }
}
