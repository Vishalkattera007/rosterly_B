<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index($id = null){

        if($id!=null){
            $emp = Employee::find($id);
            if(!$emp)
            {
                return response()->json([
                    'message' => 'Employee not found'
                ], 404);
            }
            return response()->json([
                'message'=>"Particular Data",
                'data'=>$emp
            ]);

        }else{
            $emp = Employee::all();
            return response()->json([
            'message'=>"Whole List",
            'data'=> $emp
            ]);
        }
    }
    
    public function create(Request $request)
    {
        try {
            // Check if the email already exists
            $existingemp = Employee::where('email', $request->email)->first();

            if ($existingemp) {
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
            $employee = Employee::create([
                'firstName' =>  $request->firstName,
                'lastName'  =>  $request->lastName,
                'email'     =>  $request->email,
                'password' => Hash::make($request->password), 
                'phone'     =>  $request->phone,
                'created_by' =>  $request->created_by,
                'updated_by' =>  $request->updated_by,
            ]);

            return response()->json([
                'message' => "Employee Created Successfully",
                'data'   => $employee,
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
                    'message' => "Employee ID is required",
                    'status' => false
                ], 400); 
            }

            $emp = Employee::find($id);

            if (!$emp) {
                return response()->json([
                    'message' => "Employee not found",
                    'status' => false
                ], 404);
            }

           
            if ($request->has('email')) {
                $existingemp = Employee::where('email', $request->email)->where('id', '!=', $id)->first();
                if ($existingemp) {
                    return response()->json([
                        'message' => "Email already exists",
                        'status' => false
                    ], 409); 
                }
            }

            // Update admin details
            $emp->update([
                'firstName' => $request->firstName ?? $emp->firstName,
                'lastName' => $request->lastName ?? $emp->lastName,
                'companyName' => $request->companyName ?? $emp->companyName,
                'email' => $request->email ?? $emp->email,
                'phone' => $request->phone ?? $emp->phone,
                'updated_by' => $request->updated_by ?? $emp->updated_by,
                'created_by' => $request->created_by ?? $emp->created_by
            ]);

            if ($request->has('password') && !empty($request->password)) {
                $emp->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            return response()->json([
                'message' => "Employee {$id} Updated Successfully",
                'data' => $emp
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
                'message'=>"Employee {$id} Deleted Successfully",
            ]);
        }else{
            return response()->json([
                'message'=>"Select any for Delete",
            ]);
        }
    }
}
