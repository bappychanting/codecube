<?php
  
namespace Base;
  
class Request
{

    // Data setter and geter
  public static function setData($key, $value){
    $_SESSION['request'][$key] = $value;
  }

  public static function getData($key){
    if(isset($_SESSION['request'][$key])){
      return $_SESSION['request'][$key];
    }
  }

    // Flash setter and geter
  public static function setFlash($flash){
    $_SESSION['request']['flash'] = $flash;
  }
  public static function getFlash(){
    if(isset($_SESSION['request']['flash'])){
      $flash = $_SESSION['request']['flash']; 
      unset($_SESSION['request']['flash']);
      return $flash;
    }
  }

    // Put Array in request
  public static function put($key, $arr = array()){
    $_SESSION['request'][$key] = $arr;
  }

    // Get Array from request
  public static function show($key){
    if(isset($_SESSION['request'][$key])){
      return (object)$_SESSION['request'][$key];
    }
  }

    // Auth setter and geter
  public static function setAuth($value){
    $_SESSION['request']['auth'] = $value;
  }
  public static function getAuth(){
    if(isset($_SESSION['request']['auth'])){
      return (object)$_SESSION['request']['auth'];
    }
  }

    // Check if auth
  public static function auth(){
    if(isset($_SESSION['request']['auth']) && count($_SESSION['request']['auth']) > 0 ){
      return TRUE;
    }
    return FALSE;
  }

    // destroy Request session array
  public static function destroy($key){
    unset($_SESSION['request'][$key]);
    return TRUE;
  }

}
  
?>