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
      return self::response($message, $val_messages, false);
    }

    public static function success(array $data = [], string $message='Success!'){
      return self::response($message , $data);
    }

    public static function fail(string $message='Exception found!', array $details=[], int $code=500){
      logger('Exception Found: '.json_encode($details));
      return self::response($message, $details, false, $code);
    }

    public static function response(string $message ="", array $details=[], bool $result= true, int $code = 200){
        header('Content-Type: application/json');
        return json_encode([
            "result" => $result,
            "code" => $code,
            "message" => $message,
            "details" => $details
        ], JSON_PRETTY_PRINT);
    }
}

?>