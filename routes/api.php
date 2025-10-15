<?php

use Illuminate\Support\Facades\Route;

// region Users
Route::prefix('users')
    ->name('users.')
    ->group(base_path('routes/api/users.php'));
// endregion

