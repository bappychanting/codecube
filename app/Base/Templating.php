<?php
  
namespace App\Base;

require_once('Inheritance.php');
require_once('View.php');

class Templating 
{

    // Function for setting session data */
  public static function setSubmittedData(){
    $_SESSION['data'] = $_POST;
  }

    // Function for getting data
  public static function getSubmittedData($allData){  
    if(isset($_SESSION['data'])){
      foreach($_SESSION['data'] as $key => $value){
        if(array_key_exists($key, $allData)){
          $allData[$key] = $value;
        }
      }
      unset($_SESSION['data']);
    }
    return $allData;
  } 

    // Fucntion for getting config
  public static function config($location='')
  {
    $locationArray =  explode(".",$location);

    $file = 'config';
    foreach ($locationArray as $loc) {
      $file .= '/'.$loc; 
    }
    $file .= '.php';

    if(file_exists($file)){
      $config = include($file);
      return $config;
    }
  }

    // Function for generating view
  public static function view($_location='', $_data=array())
  {
    $_location_array =  explode(".",$_location);

    $_file = 'resources/views';
    foreach ($_location_array as $loc) {
      $_file .= '/'.$loc; 
    }
    $_file .= '.php';

    if(!empty($_data)){
      extract($_data);
    }

    if(file_exists($_file)){
      include($_file);
    }
  }

    // Fucntion for generating log
  public static function log($log_msg = '')
  {
    $log_filename = "storage/logs";
    if (!file_exists($log_filename)) 
    {
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/log-' . date('Y-m-d') . '.log';
    file_put_contents($log_file_data, '['.date('Y-m-d H:i:s').'] '.$log_msg . "\n", FILE_APPEND);
  }

}

?>