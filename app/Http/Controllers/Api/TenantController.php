<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\Rules;
use App\Models\Tenant;
use App\Models\User;
use Validator;
use Auth;

class TenantController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $success = Tenant::with('domains')->get();
            return $this->sendResponse($success, 'Companies fatch successfully.', 201);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->sendError('InternalServerError.', ['error'=>'InternalServerError'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
                'email' => 'required|email|unique:tenants',
                'domain_name' => 'required|string|unique:domains,domain||max:255',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'password_confirmation' => 'required|same:password',
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors(), 403);
            }
            $input = $request->all();


            $tenant = Tenant::create($input);
            $tenant->domains()->create([
                'domain' => $request->domain_name.'.'.config('app.domain')
            ]);
            $tenant->domain_url = 'http://'.$request->domain_name.'.'.config('app.domain');
            tenancy()->initialize($tenant);
            $user = User::create($input);
            return $this->sendResponse($tenant, 'Company created successfully.', 201);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
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
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}
