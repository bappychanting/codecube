<?php

namespace App\Helpers; 

class ApiHelper{

    public static function request() {
      return [
        'headers' => apache_request_headers(), 
        'params' => $_GET, 
        'body' => $_POST
      ];
    }

    public static function validator(array $val_messages = [], string $message='Validation failed!') {
      logger('Validation failed: '.json_encode($val_messages));
      return self::fail($message, $val_messages, 5001);
    }

    public static function success(array $data = [], string $message='Success!'){
      return self::response([
        'message' => $message, 
        'data' => $data
      ]);
    }

    public static function fail(string $message='Exception found!', array $error=[], int $code=500, int $status_code=400){
      logger('Exception Found: '.json_encode($error));
      return self::response([
        'message' => $message, 
        'code' => $code,
        'error' => $error
      ], false, $status_code);
    }

    public static function response(array $details=[], bool $result= true, int $status_code=200){
        header('Content-Type: application/json', TRUE, $status_code);
        return json_encode([
          'result' => $result,
          'details' => $details
        ], JSON_PRETTY_PRINT);
    }
}

?>