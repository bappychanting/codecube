<?php
  
namespace App\Base;

class BaseController {

    // Function for setting session data */
  public function setSubmittedData(){
    $_SESSION['data'] = $_POST;
  }

    // Function for getting data
  public function getSubmittedData($allData){  
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

    // Function for checking resultselt
  public function showResult($result, $page, $alertMessage = "Empty Result: Nothing found in the database!", $pagination=''){  
      if($result){
        foreach($result as $key => $value){
      if(!empty($result[$key]['update_date'])){
          $result[$key]['update_date'] = date("F d (l), Y", strtotime($value['update_date']));
        }
        else{
          $result[$key]['update_date'] = "<span class='label bg-orange'>Not updated yet!</span>";
        }
        if(!empty($result[$key]['image'])){
          $result[$key]['image'] = Image::checkImage('all_images/', $result[$key]['image']);
        }
    }
          require_once($page);  
      }
      else{
        require_once('views/home/alert.php');
      }
  }

    // Function for creating current page title
  public function generateTitle($string=''){
    $splitString = explode('_', $string);
    $title = '';
    foreach($splitString as $split){
      $title = $title." ".ucwords($split);
    }
    return $title.' ||';
  }

  	// Function for getting current page URL
  public function getURL($exclude=''){
		if (strpos($_SERVER['REQUEST_URI'], $exclude) !== false) {
			$url = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], $exclude));
		}
		else{
			$url = $_SERVER['REQUEST_URI'];
		}
		return $url;
  }

    // Function for creating SEO friendly url
  public function sweetURL($string, $separator = '-'){
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array( '&' => 'and', "'" => '');
    $string = mb_strtolower( trim( $string ), 'UTF-8' );
    $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
    $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
    $string = preg_replace("/[$separator]+/u", "$separator", $string);
    return $string;
  } 

    // Fucntion for setting page name
  public function setPageName(){
    $parts = explode('/', $_SERVER['REQUEST_URI']);
    $getName = $parts[count($parts) - 1]; 
    $currect_name = str_replace(".php", "", $getName);
    $name = ucFirst($currect_name);
    return $name;
  }

}

?>