<?php

use App\Http\Controllers\PetStoreController;
use Illuminate\Support\Facades\Route;

Route::controller(PetStoreController::class)->group(function(){
    Route::post('/pet', 'store');
    Route::get('/pet/{id}', 'show');
    Route::put('/pet/{id}', 'update');
    Route::delete('pet/{id}', 'destroy');
});
