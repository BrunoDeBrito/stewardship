<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'assign.guard:api']], function () {
    // region Users
    Route::prefix('users')
        ->name('users.')
        ->group(base_path('routes/api/users.php'));
    // endregion
});
