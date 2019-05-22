<?php
  
namespace App\Base;
  
class Request
{

    // Data setter and geter
  public static function setData($key, $request){
    $_SESSION['request'][$key] = $request;
  }

  public static function getData($key){
    return (object)$_SESSION['request'][$key];
  }

    // Flash setter and geter
  public static function setFlash($flash){
    $_SESSION['request']['flash'] = $flash;
  }
  public static function getFlash(){
    if(isset($_SESSION['request']['flash'])){
      $flash = $_SESSION['request']['flash']; 
      unset($_SESSION['request']['flash']);
      return (object)$flash;
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

    // Input new Request
  public static function put($key, $value){
    $_SESSION['request'][$key] = $value;
  }

    // Output new Request
  public static function show($key){
    return (object)$_SESSION['request'][$key];
  }

    // destroy Request session array
  public static function destroy($key){
    unset($_SESSION['request'][$key]);
    return TRUE;
  }

}
  
?>