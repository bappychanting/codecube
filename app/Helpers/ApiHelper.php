<?php

namespace App\Helpers; 

class ApiHelper{
  public static function formatList(array $dataSet, array $requiredValues) {
        $list = [];
        if(!empty($dataSet) && !empty($requiredValues)){
          foreach($dataSet as $model) {
            foreach($requiredValues as $key){
              if(array_key_exists($key, $model)){
                $datum[$key] = array_get($model, $key);
              }
            }
            $list[] = $datum;
          }
        }
        return $list;
    }

    public static function validator($request, array $rules = []) {
        Log::info('input= '.json_encode($request));
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
            return self::fail(400,4001, $validator->messages());
        }
    }

    public static function success($data = null){
        $response = [];

        $response["result"] = true;
        $response["data"] = $data;

        $response = response($response);
        //some api-gateway sets default content-length and remove any exceeds.
        //must be declared
        return $response->header("Content-Length",strlen($response->getContent()));
    }

    public static function fail(int $status_code = 400, int $error_code = 9001, $message = "Invalid Credentials", $detail = null){
        Log::error($message);
        return response(
            [
              "result" => false,
              "error" => [
                  "code" => $error_code,
                  "message" => $message,
                  "detail" => $detail
                ]
            ],
            $status_code );
    }

    public static function error($details = null, $code=null){
        Log::error('Exception Found: '.$details);
        return self::fail(500, 5001, "Error while executing program! Code: ".$code, $details);
    }
}

?>