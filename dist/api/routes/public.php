<?php
Route::add("/", function () {
    dd("ITS WORK");
});

Route::pathNotFound(function ($path) {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    header("Content-Type: application/json");
    $res = new ResponseModel();
    $res->success = false;
    $res->error = "module: ['$path'] not found.";
    $res->dd();
});

Route::methodNotAllowed(function ($path, $method) {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed");
    header("Content-Type: application/json");

    $res = new ResponseModel();
    $res->success = false;
    $res->error = "module: ['$path'] cannot accept ['$method'].";
    $res->dd();
});
