<?php

date_default_timezone_set("Asia/Jakarta");
setlocale(LC_ALL, "id-ID");

if (!function_exists("password_hash")) {
    #password_compact PHP < 5.xx
    require_once "./lib/Password.php";
}

require "./lib/Func.php";
require "./lib/Utils.php";
require "./lib/JWT/JWT.php";
require "./lib/JWT/ExpiredException.php";
include_once "./lib/Route.php";

include_once "./datasource/BaseDs.php";

include_once "./models/ResponseModel.php";

include_once "./routes/public.php";

header("X-c0ded-bY: Adhe K");
$appName = "BaseVite";
Route::run("/api", true, true, true);
