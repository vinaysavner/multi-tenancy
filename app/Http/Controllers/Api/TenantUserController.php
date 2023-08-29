<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\Rules;
use App\Models\Tenant;
use App\Models\User;
use Validator;
use Auth;

class TenantUserController extends BaseController
{

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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //Validation
             $validator = Validator::make($request->all(),[
                 'name' => 'required|string|max:255',
                 'email' => 'required|email|unique:users',
                 'password' => ['required', 'confirmed', Rules\Password::defaults()],
             ]);
             if($validator->fails()){
                 return $this->sendError('Validation Error.', $validator->errors(), 403);
             }

             $request['role'] = 0;
             $input = $request->all();
             $user = User::create($input);
             return $this->sendResponse($user, 'User created successfully.', 201);
         } catch (\Throwable $th) {
             //throw $th;
             $responce = [
                 'success' => false,
                 'message' => 'Error'
             ];
             return response()->json($responce, 500);
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
