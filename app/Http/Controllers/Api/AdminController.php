<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;


class AdminController extends Controller
{
    //

    public function index($id = null){

        if($id!=null){
            $admin = Admin::find($id);
            if(!$admin)
            {
                return response()->json([
                    'message' => 'Admin not found'
                ], 404);
            }
            return response()->json([
                'message'=>"Particular Data",
                'data'=>$admin
            ]);

        }else{
            $admins = Admin::all();
            return response()->json([
            'message'=>"Whole List",
            'data'=> $admins
            ]);
        }
    }
    
    public function create(Request $request)
    {
        try {
            // Check if the email already exists
            $existingAdmin = Admin::where('email', $request->email)->first();

            if ($existingAdmin) {
                return response()->json([
                    'message' => "Email already exists",
                    'status' => false
                ], 409); 
            }

            if (!$request->has('password') || empty($request->password)) {
                return response()->json([
                    'message' => "Password is required",
                    'status' => false
                ], 400);
            }

            // Create a new admin
            $admin = Admin::create([
                'firstName' =>  $request->firstName,
                'lastName'  =>  $request->lastName,
                'companyName'=> $request->companyName,
                'email'     =>  $request->email,
                'password' => Hash::make($request->password), 
                'phone'     =>  $request->phone,
                'created_by' =>  $request->created_by,
                'updated_by' =>  $request->created_by,
            ]);

            return response()->json([
                'message' => "Admin Created Successfully",
                'data'   => $admin,
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
                    'message' => "Admin ID is required",
                    'status' => false
                ], 400); 
            }

            $admin = Admin::find($id);

            if (!$admin) {
                return response()->json([
                    'message' => "Admin not found",
                    'status' => false
                ], 404);
            }

           
            if ($request->has('email')) {
                $existingAdmin = Admin::where('email', $request->email)->where('id', '!=', $id)->first();
                if ($existingAdmin) {
                    return response()->json([
                        'message' => "Email already exists",
                        'status' => false
                    ], 409); 
                }
            }

            // Update admin details
            $admin->update([
                'firstName' => $request->firstName ?? $admin->firstName,
                'lastName' => $request->lastName ?? $admin->lastName,
                'companyName' => $request->companyName ?? $admin->companyName,
                'email' => $request->email ?? $admin->email,
                'phone' => $request->phone ?? $admin->phone,
                'updated_by' => $request->updated_by ?? $admin->updated_by,
                'created_by' => $request->created_by ?? $admin->created_by
            ]);

            if ($request->has('password') && !empty($request->password)) {
                $admin->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            return response()->json([
                'message' => "Admin {$id} Updated Successfully",
                'data' => $admin
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
                'message'=>"Admin {$id} Deleted Successfully",
            ]);
        }else{
            return response()->json([
                'message'=>"Select any for Delete",
            ]);
        }
    }
}
