<?php

namespace Base;

class Request
{

    // Set session data
  public static function setData($key, $value){
    $_SESSION['request'][$key] = $value;
  }

    // Get session data
  public static function getData($key){
    if(isset($_SESSION['request'][$key])){
      return $_SESSION['request'][$key];
    }
  }

    // Put array in request
  public static function put($key, $arr = array()){
    $_SESSION['request'][$key] = $arr;
  }

    // Get array from request
  public static function show($key){
    if(isset($_SESSION['request'][$key])){
      return $_SESSION['request'][$key];
    }
  }

    // Destroy request session
  public static function destroy($key){
    unset($_SESSION['request'][$key]);
  }

    // Set flash session
  public static function setFlash($flash){
    $_SESSION['request']['flash'] = $flash;
  }

    // Get flash session
  public static function getFlash(){
    if(isset($_SESSION['request']['flash'])){
      $flash = $_SESSION['request']['flash']; 
      unset($_SESSION['request']['flash']);
      return $flash;
    }
  }

    // Set cookie
  public static function setCookie($name, $value, $expire){
    $path = '/';
    $domain = APP_URL;
    $secure = APP_ENV == 'dev' ? 0 : 1;
    $httponly = APP_ENV == 'dev' ? 0 : 1;
    setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
  }

    // Get cookie data
  public static function getCookie($cookie){
    if(isset($_COOKIE[$cookie])){
      return $_COOKIE[$cookie];
    }
  }

    // Delete cookie
  public static function deleteCookie($cookie){
    unset($_COOKIE[$cookie]);
  }

}

?>