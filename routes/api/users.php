<?php

use Illuminate\Support\Facades\Route;

Route::get('/teste', function () {
    $teste = "teste";

    $tes = 1 + 2;
    return view('welcome');
});
