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
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'username' => 'required',
                'email' => 'required|email|unique:users,email',
                'number' => 'required|digits:10',
                'role' => 'required',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'number' => $request->number,
                'role' => $request->role,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
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
    // GET [Auth: Token]
    public function profile(){

        $userData = auth()->user();
        return response()->json([
            "status" => true,
            "message" => "Profile Information",
            "data" => $userData,
            "id" => auth()->user()->id
        ]);
    }

    // GET [Auth: Token]
    public function logout(){

        auth()->user()->tokens()->delete();
         return response()->json([
            "status" => true,
            "message" => "User logged out",
            "data" => []
        ]);
    }
    public function update(Request $request, $id)
    {
        // Validation rules if needed
        $request->validate([
            
        
            'username' => 'required',
            'email' => 'required|email|unique:users,email'.$id,
            'number' => 'required|digits:10',
            'role' => 'required',
            // Add more fields and validation rules as needed
        ]);

        $account = user::findOrFail($id);
        
        // Update account fields
        $account->username = $request->input('username');
        $account->email = $request->input('email');
        // Update more fields as needed
        
        $account->save();

        return response()->json($account, 200);
    }
}
