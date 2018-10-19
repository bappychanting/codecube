<?php
  
namespace App\Base;
use PDO;
  
class BaseModel {

  private $instance = NULL;
  private $bindInt = NULL;
  
  private $dbhost = NULL;
  private $dbname = NULL;
  private $dbuser = NULL;
  private $dbpass = NULL;

  public function __construct() {
    if (defined('DB_HOST')) {
      $this->dbhost = DB_HOST;
    }
    if (defined('DB_DATABASE')) {
      $this->dbname = DB_DATABASE;
    }
    if (defined('DB_USERNAME')) {
      $this->dbuser = DB_USERNAME;
    }
    if (defined('DB_PASSWORD')) {
      $this->dbpass = DB_PASSWORD;
    }
  }

  private function __clone() {}

  public function getInstance() {
    if (!isset($this->instance)) {
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $this->instance = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass, $pdo_options);
    }
    return $this->instance;     
  }

  public function bindInteger() {
    if (!isset($this->bindInt)) {
      $this->bindInt = PDO::PARAM_INT;
    }
    return $this->bindInt;
  }

    // Function for Creating string for table row
  private static function rowString($rows = ''){
      if(is_array($rows)){
        $string = '';
        foreach($rows as $row){
          $string = $string.$row.', ';
        }
        return substr($string, 0, -2);
      }
      else{
        return NULL;
      }
  }

    // Function for Creating string for table inputs
  private function inputString($rows = ''){
      if(is_array($rows)){  
        $string = '';
        foreach($rows as $row){
          $string = $string.':'.$row.', ';
        }
        return substr($string, 0, -2);
      }
      else{
        return NULL;
      }
  }

    // Function for Creating execute array
  private function parameterArray($rows = '', $inputs= '', $conditionRows = '', $conditionInputs= ''){
      if(is_array($rows) && is_array($inputs) && count($rows) == count($inputs)){
        if(is_array($conditionRows) && is_array($conditionInputs) && count($conditionRows) == count($conditionInputs)){
          for ($i = 0; $i < count($conditionRows); $i++) {
            $key = ':'.$conditionRows[$i];
            $value = $conditionInputs[$i];
            $parameterArray[$key] = $value;
          }
        }
        for ($i = 0; $i < count($rows); $i++) {
          $key = ':'.$rows[$i];
          $value = $inputs[$i];
          $parameterArray[$key] = $value;
        }
        return $parameterArray;
      }
      else{
        return NULL;
      }
  }

    // Function for Creating update input string
  private function generateUpdateString($rows = ''){
      if(is_array($rows)){ 
        $string = '';
        foreach($rows as $row){
          $string = $string.$row.' = :'.$row.', ';
        }
        return substr($string, 0, -2);
      }
      else{
        return NULL;
      }
  }

    // Function for Creating condition string
  private function generateCondition($conditionRows=''){
      if(is_array($conditionRows)){
        $string = 'WHERE ';
        foreach($conditionRows as $condition){
          $string = $string.$condition.' = :'.$condition.' AND ';
        }
        return substr($string, 0, -4);
      }
      else{
        return NULL;
      }

        // Updated create condition script
      /*if(is_array($conditionRows)){
        $string = 'WHERE ';
        foreach($conditionRows as $condition){
          $string = $string.$condition['column'].' '.$condition['symbol'].' :'.$condition['column'].' '.$condition['conjunction'].' ';
          $exclude = strlen($condition['conjunction'])+1;
        }
        return substr($string, 0, -$exclude);
      }
      else{
        return NULL;
      }*/
  }
   

    // Function for selecting data
  public static function read($tablename='', $conditionRows = '', $conditionInputs= '', $paginate='', $extra=''){
      if(!empty($tablename)){
        $pdo = $this->getInstance();
        $generateQuery = 'SELECT * FROM '.$tablename.' '.$this->generateCondition($conditionRows).$extra;

          // check if the query will paginate the data or not
        if(is_array($paginate) && array_key_exists('perpage',$paginate) && array_key_exists('page',$paginate) && array_key_exists('start',$paginate)){
      
          $perpage =  intval($paginate['perpage']); 
          $page =  intval($paginate['page']); 
          $start =  intval($paginate['start']);

            // Query for pagination
          $countQuery =  $pdo->prepare($generateQuery);
          $countQuery->execute($this->parameterArray($conditionRows, $conditionInputs)); 
          $total = $countQuery->rowCount();
          $pagination = $this->paginate($total, $perpage, $page);

            // Query for getting data
          $dataQuery = $pdo->prepare($generateQuery." LIMIT $start, $perpage");
          $dataQuery->execute($this->parameterArray($conditionRows, $conditionInputs));
          $data=$dataQuery->fetchAll();
          return array('data'=>$data, 'pagination'=>$pagination);
        }
        else{
          $query = $pdo->prepare($generateQuery);
          $query->execute($this->parameterArray($conditionRows, $conditionInputs));
          $data=$query->fetchAll();
          return $data;
        }
      }
  }

    // Function for inserting data
  public static function create($tablename='', $rows='', $inputs=''){
    if(!empty($tablename) && is_array($rows) && is_array($inputs) && count($rows) == count($inputs)){
      $pdo = $this->getInstance();

        // Creating the query command
      $generateQuery = 'INSERT INTO '.$tablename.' ('.$this->rowString($rows).') VALUES ('.$this->inputString($rows).')'; 
      //return $generateQuery;
        // Execute Query
      $query = $pdo->prepare($generateQuery);        
      $status = $query->execute($this->parameterArray($rows, $inputs));
  
      // Return Status
      return $status;
    }
  }

    // Function for updating data
  public static function update($tablename='', $rows='', $inputs='', $conditionRows = '', $conditionInputs= '', $extra=''){
    if(!empty($tablename)){
      $pdo = Database::getInstance();

        // Creating the query command
      $generateQuery = 'UPDATE '.$tablename.' SET '.$this->generateUpdateString($rows).$this->generateCondition($conditionRows).$extra; 

        // Execute Query
      $query = $pdo->prepare($generateQuery);        
      $status = $query->execute($this->parameterArray($rows, $inputs, $conditionRows, $conditionInputs));
  
      // Return Status
      return $status;
    }
  }

    // Function for deleting data
  public static function delete($tablename='', $conditionRows = '', $conditionInputs= '', $extra=''){
    if(!empty($tablename)){
      $pdo = Database::getInstance();

        // Creating the query command
      $generateQuery = 'DELETE FROM '.$tablename.$this->generateCondition($conditionRows).$extra; 

       // Execute Query
      $deleteQuery = $pdo->prepare($generateQuery);
      $status = $query->execute($this->parameterArray($conditionRows, $conditionInputs));
  
        // Return Status
      return $status;
    }
  }

          // Function for declaring pagination
  public static function paginate_declare($perpage=1) {
    if(isset($_GET["page"])){
        $page = intval($_GET["page"]);
    }
    else {
      $page = 1;
    }
    $calc = $perpage * $page;
    $start = $calc - $perpage;
    return array("perpage"=>$perpage, "page"=>$page, "start"=>$start);
  }    

    // Funcntion for pagination
  public static function paginate($total=1, $perpage=1, $page=1) {
    $url = $this->getURL('&page');
    $totalPages = ceil($total / $perpage);
    $navigation = array('nav'=>'', 'skip_previous'=>'', 'previous'=>'', 'link'=>'', 'next'=>'', 'skip_next'=>'','endnav'=>'');
    $navigation['nav'] = "<nav><ul class='pagination'>";
    if($page > 1 ){
      $navigation['skip_previous'] = "<li>
                <a href='$url&page=1' class='waves-effect'>
                    |<
                </a>
            </li>";
    }
  
    if($page <=1 ){
      $navigation['previous'] = " <li class='disabled'>
                    <a href='javascript:void(0);'>
                        Previous
                    </a>
                </li>";
    }
    else{
    $j = $page - 1;
      $navigation['previous'] = " <li>
                <a href='$url&page=$j' class='waves-effect'>
                    Previous
                </a>
            </li>";
    }
  
    if ($totalPages >=1 && $page <= $totalPages){
      $range = 2;
      $limit = $range+1;
      $navigation['link'] = "";
      if ($page > $limit){ 
        $navigation['link'] = "<li><a href='$url&page=1' class='waves-effect'>1</a></li>
        <li class='disabled'><a href = 'javascript:void(0);'>...</a></li>";
      }
          for($i= ($page-$range); $i <(($page + $range)  + 1); $i++){
        if (($i > 0) && ($i <= $totalPages)){
          if($i<>$page){
            $navigation['link'] .= "<li> <a href='$url&page=$i' class='waves-effect'>$i</a></li>";
          }
          else{
            $navigation['link'] .= "<li class='active'><a href='javascript:void(0);'>$i</a></li>";
          }       
        }
          }
          if ($page <= $totalPages - $limit){ 
      $navigation['link'] .= "<li class='disabled'><a href = 'javascript:void(0);'>...</a></li>
          <li> <a href='$url&page=" .$totalPages." ' class='waves-effect'>$totalPages</a></li>"; 
      }
    } 
    if($page == $totalPages ){
      $navigation['next'] = "<li class='disabled'>
         <a href='javascript:void(0);'>
                    Next
                </a>
             </li>";
    }
    else{
      $j = $page + 1;
      $navigation['next'] = "<li>
         <a href='$url&page=$j' class='waves-effect'>
                    Next
                </a>
             </li>";
    }
    if($page < $totalPages ){ 
      $navigation['skip_next'] = "<li>
              <a href='$url&page=" .$totalPages." ' class='waves-effect'>
                  >|
              </a>
          </li>"; 
    }
    $navigation['endnav'] = "</ul></nav>";
    return $pagination = $navigation['nav'].$navigation['skip_previous'].$navigation['previous'].$navigation['link'].$navigation['next'].$navigation['skip_next'].$navigation['endnav'];
  }


}
  
?>