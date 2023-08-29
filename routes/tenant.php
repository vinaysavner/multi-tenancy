<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Api\TenantUserController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::controller(TenantUserController::class)->middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return response()->json(tenant(), 200);
    });
    Route::post('login','login');
    Route::post('register','register');
});

Route::controller(TenantUserController::class)->middleware([
    'api',
    'auth:sanctum',
    'restrictToUser',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->prefix('user')->group(function () {
    Route::post('create','store');
});
