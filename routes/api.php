<?php

use Illuminate\Support\Facades\Route;

Route::as("api.")->group(function () {
    require __DIR__ . "/api/UserRoutes.php";
});
