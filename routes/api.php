<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api', 'ForceJsonResponse']], function () {

    Route::post('/patient', [\App\Http\Controllers\PatientController::class, 'create']);
});
