<?php

namespace App\Helpers; 

class Misc{

    // Function For Plucking
  public static function pluck($array = array(), $column= '')
  {
    $plucked = array();
    if(!empty($column) && !empty($array)){
      foreach($array as $arr){
        array_push($plucked, $arr[$column]);
      }
    }
    return $plucked;
  }

  public static function createArrString($strArray = array())
  {
    $str = '';
    $count = 1;
    if(!empty($strArray)){
      foreach($strArray as $arr){
        if($count != count($strArray)){
          $str .= $arr.', ';
        }
        else{
          $str .= $arr;
        }
        $count++;
      }
    }
    return $str;
  }

    // Function for creating SEO friendly url
  public function urlString($string, $separator = '-'){
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array( '&' => 'and', "'" => '');
    $string = mb_strtolower( trim( $string ), 'UTF-8' );
    $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
    $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
    $string = preg_replace("/[$separator]+/u", "$separator", $string);
    return $string;
  }

    // Function for cutting a string
  public static function substrwords($text, $maxchar, $end='...') {
      if (strlen($text) > $maxchar || $text == '') {
          $words = preg_split('/\s/', $text);      
          $output = '';
          $i      = 0;
          while (1) {
              $length = strlen($output)+strlen($words[$i]);
              if ($length > $maxchar) {
                  break;
              } 
              else {
                  $output .= " " . $words[$i];
                  ++$i;
              }
          }
          $output .= $end;
      } 
      else {
          $output = $text;
      }
      return $output;
  }

    //  Function for generating HTML colors
  public static function generateColor(){
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
  } 

    // Function for generating year array
  public static function generateYearArray($previousYears = 1){
    $dates = array();
    for ($year=date("Y")-intval($previousYears); $year<=date("Y"); $year++) {
        for ($month=1; $month<=12; $month++) {
            $begin = strtotime($year."-".$month."-01 12:00:00AM");
            $end = strtotime($year."-".($month+1)."-01 12:00:00AM")-1;
            $key = date("F", $begin); 
            $dates[$year][$key] = array(
                'start' => $begin,
                'end' => $end
            );
        }
    }
    return $dates;
  }

   
}

?>