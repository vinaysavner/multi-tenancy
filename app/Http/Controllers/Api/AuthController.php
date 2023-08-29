<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Validator;
use Auth;

class AuthController extends BaseController
{
    public function register(Request $request){
        try {
            //Validation
            $validator = Validator::make($request->all(),[
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors(), 403);
            }

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);

            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'User register successfully.', 201);
        } catch (\Exception $err) {
            // return response()->json($err, 500);
            return $this->sendError('InternalServerError.', ['error'=>'InternalServerError'], 500);
        }
    }

    public function login(Request $request){
        //Validation
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 403);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            return $this->sendResponse($success, 'User login successfully.', 200);
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised'], 401);
        }
    }
}
