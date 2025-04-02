<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index($id = null){

        if($id!=null){
            $role = Role::find($id);
            if(!$role)
            {
                return response()->json([
                    'message' => 'Role not found'
                ], 404);
            }
            return response()->json([
                'message'=>"Particular Data",
                'data'=>$role
            ]);

        }else{
            $role = Role::all();
            return response()->json([
            'message'=>"Whole List",
            'data'=> $role
            ]);
        }
    }

    public function create(Request $request)
    {
        try {
            // Create a new admin
            $role = Role::create([
                'RoleName' =>  $request->RoleName,
                'created_by' =>  $request->created_by,
                'updated_by' =>  $request->updated_by,
            ]);

            return response()->json([
                'message' => "Role Created Successfully",
                'data'   => $role,
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
                    'message' => "Role ID is required",
                    'status' => false
                ], 400); 
            }

            $role = Role::find($id);
            if (!$role) {
                return response()->json([
                    'message' => "Role not found",
                    'status' => false
                ], 404);
            }

            // Update admin details
            $role->update([
                'RoleName' => $request->RoleName ?? $role->RoleName,
                'updated_by' => $request->updated_by ?? $role->updated_by,
                'created_by' => $request->created_by ?? $role->created_by
            ]);

            return response()->json([
                'message' => "Role {$id} Updated Successfully",
                'data' => $role
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
                $role = Role::find($id);
                if($role){
                    $role->delete();
                    return response()->json([
                    'message'=>"Role {$id} Deleted Successfully",
                ]);
            }else{
                return response()->json([
                    'message'=>"Select any for Delete",
                ]);
            }
        }
    }
}
