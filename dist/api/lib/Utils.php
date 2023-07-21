<?php

use Firebase\JWT\JWT;

class Utils
{
  private function __construct()
  {
    //
  }

  public static function publicKey()
  {
    return <<<EOD
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAn6NbOZ33qJe7gwTjIrB6
eRLJX0lcdsvcGcMUj2OBDYz91tT7PUeW8mp8WWrtD05STqdlFoSMv4xKnAHWIIvv
Dmg5nwjc8ArKekTwrF9yIXKEQg4n+iSXMs/9Od00d7SV2yPQof/CtvIYHn12bLjA
2/jWCo/RJVXnDwFe0MCrjCpt+a72Uw3tyY1DxNARVRMkkl93/bQfs/u86atpJHLz
HdW+gjcc4ira+pAQg85QS7ezjDExI/NLVaYU7up02mAs8uyCGgA7TY3+5KlOKFNC
mTQ8ROnL3rtruitaLKWlmXJl9ajw1ouJ+a6JeWPCK5KLhZkA73Voj2YursLYSn9P
nQIDAQAB
-----END PUBLIC KEY-----
EOD;
  }

  public static function privateKey()
  {
    return <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEAn6NbOZ33qJe7gwTjIrB6eRLJX0lcdsvcGcMUj2OBDYz91tT7
PUeW8mp8WWrtD05STqdlFoSMv4xKnAHWIIvvDmg5nwjc8ArKekTwrF9yIXKEQg4n
+iSXMs/9Od00d7SV2yPQof/CtvIYHn12bLjA2/jWCo/RJVXnDwFe0MCrjCpt+a72
Uw3tyY1DxNARVRMkkl93/bQfs/u86atpJHLzHdW+gjcc4ira+pAQg85QS7ezjDEx
I/NLVaYU7up02mAs8uyCGgA7TY3+5KlOKFNCmTQ8ROnL3rtruitaLKWlmXJl9ajw
1ouJ+a6JeWPCK5KLhZkA73Voj2YursLYSn9PnQIDAQABAoIBAQCM3/GfFOH6q3vU
EToH4MkTkxqVtf2c8CXZrie0qdC3DpbrQKQ93bE9V+9IUW3Ftg44TsyMZIh4eOtW
ZOB7dEGP6zX+PCoMwtkPsUraMphbH93LFQb+Xc/4DUegCq9Ee95Ktn5kl3lTTK0w
KvOY2imHdT4dr/CXDAmNWl47xesdEueNHqrwIsWyW4y2GyG6OOqMY8E/hLqxzZuG
x3ErJOiA4dnet0Z+x257ltDmo2YftqnkRl3vTxK/klT6UbWWbFgN9ovJKX3AySBU
2edaeXVcpuH/rppsgPEzUQzGQ2sI1WyjFG6642F5P7yWHIwXSVcGnbHEYmIiQjHi
2/o8UuRZAoGBAMw/hJ6RFZS279gO5AdFdnmRMmCdY2MsXa5+2WYRwBXf4BuZWSjx
pa9/V/m2YBzq84NYi/Kpe8b4pNBJ1ckJE7d0MNGxUvF6Tqi7q86bVG8X7IOlf5uQ
Y1jffnjS6lOMmnAEzMIc4W9ICzpkxQD+//Xz1ZXUia/BeCGztFxw1deTAoGBAMgW
OdpVszvhLvwRZCFEcYGupdjHydfvoQrvtRJwale23MGeMAFZ+f8Nho8pDpFq7RBh
U08vbxIztctmszNtEzR6Ul3x+KPyXI4cVp6mP8xsE4oG+4SQMeRtpoO+JAbzH7LD
PHoDdkKMBn0rZw0UbuWQidibS98HS53ap81/2loPAoGAKY/jVMEBOznepICjNjeU
XDiHn9FnIA8vIQr/Ah4qkEj2OaeC1SoXJRcst8u80yWcV+X01HRYk6yVHS1pK3eF
Y5dpN8J1tl3FE+DcnTZOgCzGHCPZS7aeAL+55KxGsqmx44mWgQmPdi2a208WJ5W8
UDhGBi8xtWoRIAqJcSYk3bECgYB29vAS5t2Yfrzm1phIR1+NkX++MpvKLgn8bKWm
fvxbhrgezqUQSKUhhrM4r1qgD4lAMf3MmRFbKy+t7jQiIXpHu2r5vILvR4zMWgEO
dx57ts6vRJOLMAjaHm/g6M6W6zsvmHF+wkwwKP06svGkjz+YcqXjCgLEapwFERqw
TpJO9QKBgQCank1sqIh3wjt1A9/hJ35nPBLQQeCqq1cbnPhLKGFyrbmv2MNcE/88
Wr4JFj9CUMFnAemwyRyAf8bdVPYDQnUrCpO7d3WW0h6JNAlPQR3ThQ9BiIf/4RUn
eYCg55oakGLe4XpNZBVC/lLyNGodwtQpI6RNkIdNsr0ifwaeQKQf2g==
-----END RSA PRIVATE KEY-----
EOD;
  }

  public static function privateToken($authData)
  {
    $sekarang = time();
    $payload = [
      "role" => "externalApp",
      "iss" => "PuSaKa Backend (PHP Version)",
      "iat" => $sekarang,
      "exp" => $sekarang + 60 * 60 * 20, //exp in 20h
      "authData" => $authData,
    ];

    $apiToken = JWT::encode($payload, self::privateKey(), "RS256");

    return $apiToken;
  }

  public static function verifyToken($token)
  {
    $ret = new stdClass();
    $ret->success = false;

    try {
      $required = [
        "role",
        "iss",
        "iat",
        "exp",
        "authData",
      ];

      $tokenDecoded = JWT::decode($token, self::publicKey(), ["RS256"]);

      foreach ($required as $index => $val) {
        if (!property_exists($tokenDecoded, $val)) {
          $ret->success = false;
          $ret->error = "Failed to decode apiKey. Please login again.";
          return $ret;
        }
      }

      $ret->success = true;
      $ret->data = $tokenDecoded->authData;
    } catch (UnexpectedValueException $e) {
      $ret->success = false;
      $ret->error = $e->getMessage();
    }
    return $ret;
  }

  public static function encodeStr(string $str, string $key = "ValCrypt-Adhe")
  {
    #code
    if (strlen($str) == 0) {
      return "";
    }
    $bufferArray = "";
    $indexKey = 0;
    for ($i = 0; $i < strlen($str); $i++) {
      # code...
      if ($indexKey == strlen($key)) {
        $indexKey = 0;
      }
      $element = ord($str[$i]);
      $bufferInt = 0;
      if ($i % 2 == 0) {
        $bufferInt = $element + ord($key[$indexKey]) - 10;
      } else {
        $bufferInt = $element - ord($key[$indexKey]) + 12;
      }
      $bufferArray .= chr($bufferInt);
      $indexKey++;
    }
    return base64_encode($bufferArray);
  }

  public static function getHeader($keyParams = "authorization")
  {
    $keyParams = strtolower($keyParams);

    $headers = [];
    if (!function_exists("getallheaders")) {
      foreach ($_SERVER as $name => $value) {
        /* RFC2616 (HTTP/1.1) defines header fields as case-insensitive entities. */
        if (strtolower(substr($name, 0, 5)) == "http_") {
          $headers[str_replace(
            " ",
            "-",
            ucwords(strtolower(str_replace("_", " ", substr($name, 5))))
          )] = $value;
        }
      }
    } else {
      $headers = getallheaders();
    }
    foreach ($headers as $key => $value) {
      if (strtolower($key) == $keyParams) {
        //$tmp = explode(" ", trim($value));
        //return trim($tmp[count($tmp) - 1]);
        return $value;
      }
    }
    return false;
  }

  public static function getUserIpAddr()
  {
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
      $ip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
      $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
      $ip = $_SERVER["REMOTE_ADDR"];
    }
    return $ip == "::1" ? "127.0.0.1" : $ip;
  }

  public static function getUserAgent()
  {
    $ua = isset($_SERVER["HTTP_USER_AGENT"])
      ? $_SERVER["HTTP_USER_AGENT"]
      : null;
    return $ua;
  }

  public static function formatDateIndo($date = null)
  {
    if ($date === null) {
      $date = date("Y-m-d");
    }
    $bulanMapping = [
      "01" => "Januari",
      "02" => "Februari",
      "03" => "Maret",
      "04" => "April",
      "05" => "Mei",
      "06" => "Juni",
      "07" => "Juli",
      "08" => "Agustus",
      "09" => "September",
      "10" => "Oktober",
      "11" => "November",
      "12" => "Desember",
    ];
    $pecahkan = explode("-", $date);
    return $pecahkan[2] .
      " " .
      $bulanMapping[$pecahkan[1]] .
      " " .
      $pecahkan[0];
  }

  public static function formatDateTimeIndo($date = null)
  {
    if ($date === null) {
      $date = date("d m Y, H:i:s T");
    }

    $bulanMapping = [
      "01" => "Januari",
      "02" => "Februari",
      "03" => "Maret",
      "04" => "April",
      "05" => "Mei",
      "06" => "Juni",
      "07" => "Juli",
      "08" => "Agustus",
      "09" => "September",
      "10" => "Oktober",
      "11" => "November",
      "12" => "Desember",
    ];
    $pecahkan = explode(" ", $date);
    return $pecahkan[0] .
      " " .
      $bulanMapping[$pecahkan[1]] .
      " " .
      $pecahkan[2] .
      " " .
      $pecahkan[3] .
      " " .
      $pecahkan[4];
  }

  public static function formatDateTimeFromUnix($unix = null)
  {
    if ($unix === null) {
      $unix = time();
    }
    $date = date("d m Y, H:i:s T", $unix);

    $bulanMapping = [
      "01" => "Januari",
      "02" => "Februari",
      "03" => "Maret",
      "04" => "April",
      "05" => "Mei",
      "06" => "Juni",
      "07" => "Juli",
      "08" => "Agustus",
      "09" => "September",
      "10" => "Oktober",
      "11" => "November",
      "12" => "Desember",
    ];
    $pecahkan = explode(" ", $date);
    return $pecahkan[0] .
      " " .
      $bulanMapping[$pecahkan[1]] .
      " " .
      $pecahkan[2] .
      " " .
      $pecahkan[3] .
      " " .
      $pecahkan[4];
  }

  private static function decodeStr(string $str, string $key = "ValCrypt-Adhe")
  {
    if (strlen($str) == 0) {
      return "";
    }
    $bufferArray = "";
    $rawStr = base64_decode($str);
    $indexKey = 0;
    for ($i = 0; $i < strlen($rawStr); $i++) {
      if ($indexKey == strlen($key)) {
        $indexKey = 0;
      }
      $element = ord($rawStr[$i]);
      $bufferInt = 0;
      if ($i % 2 == 0) {
        $bufferInt = $element - ord($key[$indexKey]) + 10;
      } else {
        $bufferInt = $element + ord($key[$indexKey]) - 12;
      }
      $bufferArray .= chr($bufferInt);
      $indexKey++;
    }

    return $bufferArray;
  }

  public static function generateId(int $length = 32)
  {
    $length = $length < 4 ? 4 : $length;
    return bin2hex(random_bytes(($length - ($length % 2)) / 2));
  }

  public static function generateCode(int $length = 6)
  {
    $ret = "";
    $ALPHA = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    for ($i = 0; $i < $length; $i++) {
      $ret .= $ALPHA[rand(0, 35)];
    }
    return $ret;
  }

  public static function countAge($tgl)
  {
    $birthDate = new DateTime($tgl);
    $today = new DateTime("today");
    if ($birthDate > $today) {
      exit("0 tahun");
    }
    $y = $today->diff($birthDate)->y;
    return $y . " tahun";
  }
}
