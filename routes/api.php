<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

foreach (glob(__DIR__ . '/MainRoutes/*.php') as $routeFile) {
    require $routeFile;
}