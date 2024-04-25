<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(Request $request)
    {
        try {
            // Validation
            $validateUser = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'nullable',
                'email' => 'required|email|unique:users,email',
                'numero' => 'required|digits:10|unique:users,numero',
                'photo_url' => 'nullable',
                'is_active' => 'nullable|boolean',
                'password' => 'required',
            ]);
    
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
    
            // Create user
            $user = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'numero' => $request->numero,
                'photo_url' => $request->photo_url,
                'is_active' => $request->is_active ?? false, // Default to false if not provided
                'password' => Hash::make($request->password)
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    
    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $id,
            'numero' => 'required|digits:10|unique:users,numero,' . $id,
            'photo_url' => 'nullable',
            'is_active' => 'nullable|boolean',
            'password' => 'required',
        ]);
    
        // Find the user
        $user = User::findOrFail($id);
        
        // Update user data
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->numero = $request->input('numero');
        $user->photo_url = $request->input('photo_url');
        $user->is_active = $request->input('is_active') ?? true; 
        $user->password = Hash::make($request->input('password'));
    
        $user->save();
    
        return response()->json($user, 200);
    }
    public function login(Request $request){

        // Validation
        $request->validate([
            "email" => "required|email|string",
            "password" => "required"
        ]);

        // Email check
        $user = User::where("email", $request->email)->first();

        if(!empty($user)){
            // User exists
            if(Hash::check($request->password, $user->password)){
                // Password matched
                $token = $user->createToken("mytoken")->plainTextToken;
                return response()->json([
                    "status" => true,
                    "message" => "User logged in",
                    "token" => $token,
                    "data" => []
                ]);
            }else{
                return response()->json([
                    "status" => false,
                    "message" => "Invalid password",
                    "data" => []
                ]);
            }
        }else{
            return response()->json([
                "status" => false,
                "message" => "Email doesn't match with records",
                "data" => []
            ]);
        }
    }
}
