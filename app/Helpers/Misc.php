<?php

namespace App\Helpers; 

class Misc{

    // Function For getting values with specific key from array
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

    // Function for generating random number of fixed length
  public static function randInt($length = 10) {
    $result = '';
    for($i = 0; $i < $length; $i++) {
      $result .= mt_rand(0, 9);
    }
    return $result;
  }

    // Function for generating random string
  public static function randStr($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

    // Function for creating SEO friendly url
  public static function urlString($string, $separator = '-'){
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

  public static function createCalendarDateRange($strDateFrom='',$strDateTo='')
  {
    $aryRange=array();

    $start_date = empty($strDateFrom) ? date('Y-01-01') : date('Y-m-d', strtotime($strDateFrom)); 
    $end_date = empty($strDateTo) ? date('Y-12-31') : date('Y-m-d', strtotime($strDateTo)); 

      // Initialize Date From
    $iDateFrom=mktime(1, 0, 0, substr($start_date,5,2), substr($start_date,8,2), substr($start_date,0,4));
    $iDateFrom-=86400; 

      // Initialize Date To
    $iDateTo=mktime(1, 0, 0, substr($end_date,5,2), substr($end_date,8,2), substr($end_date,0,4));

    if ($iDateTo>=$iDateFrom){
      while ($iDateFrom<$iDateTo){ 
        $iDateFrom+=86400; // add 24 hours
        $month = date('m', $iDateFrom);
        $wk = date('W', $iDateFrom);
        $wkDay = date('D', $iDateFrom);
        $aryRange[$month][$wk][$wkDay] = ['date_of_month' => date('d', $iDateFrom), 'date' => date('Y-m-d',$iDateFrom)]; 
      }
    }
    unset($aryRange[0]);
    return $aryRange;
  }

}

?>