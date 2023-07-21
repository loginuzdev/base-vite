<?php

/**
 * Global function modules
 */
if (!function_exists("dd")) {
  function dd($var, $error = false)
  {
    header("Content-Type: application/json");
    if ($var instanceof ResponseModel) {
      echo json_encode($var, JSON_PRETTY_PRINT);
      die();
    }

    if ($error) {
      echo json_encode(
        [
          "success" => false,
          "error" => $var,
        ],
        JSON_PRETTY_PRINT
      );
    } else {
      echo json_encode(
        [
          "success" => true,
          "data" => $var,
        ],
        JSON_PRETTY_PRINT
      );
    }

    die();
  }

  function js_compact($var)
  {
    echo json_encode($var, JSON_PRETTY_PRINT);
    die();
  }

  function jsonData($data)
  {
    return str_ireplace("\"", "'", str_ireplace("'", "\"", json_encode($data)));
  }

  function loadViews($file, $data = [])
  {
    define("APP_NAME", "R1 PUS Salatiga");
    define("BASEPATH", baseUrl());
    $path = dirname(__FILE__);
    if (strpos($file, ".php") !== false) {
    } else {
      $file = "$file.php";
    }
    $path = str_replace(DIRECTORY_SEPARATOR . "lib", "", $path);
    if (!file_exists("$path/layouts/$file")) {
      header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
      header("Content-Type: application/json");
      $res = new ResponseModel();
      $res->success = false;
      $res->error = "module: ['$path/layouts/$file'] not found.";
      $res->dd();
      return;
    }
    $assetsDir = baseUrl("assets");
    include_once "$path/layouts/$file";
    return;
  }

  function loadCss($fileName)
  {
    return baseUrl("assets/css/$fileName");
  }

  function loadJs($fileName)
  {
    return baseUrl("assets/js/$fileName");
  }

  function baseUrl($path = "/")
  {
    $tmp =
      isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? "https" : "http";
    $tmp .= "://" . $_SERVER["HTTP_HOST"];
    $tmp .= str_replace(
      basename($_SERVER["SCRIPT_NAME"]),
      "",
      $_SERVER["SCRIPT_NAME"]
    );
    if ($path != "/") {
      return $tmp . $path;
    }
    return $tmp;
  }

  function getParamValue($paramKey, $isPost = false, $fallback = null)
  {
    $ret = null;
    if ($isPost) {
      $ret = isset($_POST[$paramKey]) ? $_POST[$paramKey] : null;
    } else {
      $ret = isset($_GET[$paramKey]) ? $_GET[$paramKey] : null;
    }
    if ($ret === null) {
      if ($fallback != null) {
        $ret = $fallback;
      }
    }
    return $ret;
  }

  function serializeObj($obj)
  {
    return base64_encode(serialize($obj));
  }

  function unserializeObj($str)
  {
    return unserialize(base64_decode($str));
  }

  function redirect($path = "/")
  {
    header("Location: " . baseUrl($path));
    exit();
  }
  function parseJson($raw)
  {
    $j = json_decode($raw);
    if (json_last_error() !== 0) {
      return false;
    } else {
      return $j;
    }
  }
}
