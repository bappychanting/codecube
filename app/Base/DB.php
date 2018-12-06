<?php
  
namespace App\Base;
use PDO;
  
class DB
{

    // Declaring database query variables
  private $bindInt;
  private $instance;
  private $table;
  private $queryString;
  private $paginate;
  private $execArray;
  
    // Declaring database credentials
  private $dbhost;
  private $dbname; 
  private $dbuser;
  private $dbpass;

  public function __construct() 
  {
    $this->bindInt = NULL;
    $this->instance = NULL;
    $this->table = '';
    $this->queryString = '';
    $this->paginate = '';
    $this->execArray = array();

    $this->dbhost = '127.0.0.1';
    $this->dbname = 'homestead';
    $this->dbuser = 'homestead';
    $this->dbpass = 'secret';

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

  private function __clone() 
  {

  }

    // Returning database instance
  public function getInstance() 
  {
    if (!isset($this->instance)) {
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $this->instance = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass, $pdo_options);
    }
    return $this->instance;     
  }

    // Binding integer to numeric values
  public function bindInteger() 
  {
    if (!isset($this->bindInt)) {
      $this->bindInt = PDO::PARAM_INT;
    }
    return $this->bindInt;
  }

    // Add conditions and string to query
  private function addQuery($row, $op, $value){
    if(!empty($row) && !empty($op) && !empty($value)){
      $this->queryString .= ' ';
      $this->queryString .= $row.' '.$op.' :'.$row;
      $this->queryString .= ' ';
      $this->execArray[':'.$row] = $value;
    }
  }

    // Check if a column exists
  private function checkColumn($column){
    $pdo = $this->getInstance();
    if(count($pdo->query("SHOW COLUMNS FROM `".$this->table."` LIKE '".$column."'")->fetchAll())){
      return TRUE;
    } 
  }

    // Selecting table
  public function table($table='')
  {
    $this->table = $table;
    return $this;
  }

    // Including conditions
  public function where($row='', $op='', $value='')
  {
    $this->queryString .= 'WHERE';
    $this->addQuery($row, $op, $value);
    return $this;
  }

    // Including AND conditions
  public function and($row='', $op='', $value='')
  {
    $this->queryString .= 'AND';
    $this->addQuery($row, $op, $value);
    return $this;
  }

    // Including OR conditions
  public function or($row='', $op='', $value='')
  {
    $this->queryString .= 'OR';
    $this->addQuery($row, $op, $value);
    return $this;
  }

    // Including NOT conditions
  public function not($row='', $op='', $value='')
  {
    $this->queryString .= ' ';
    $this->queryString .= 'NOT';
    $this->addQuery($row, $op, $value);
    return $this;
  }

    // Including Order By Statement
  public function orderBy($row='created_at', $order='ASC')
  {
    if(strpos($this->queryString, 'ORDER BY') == false){
      $this->queryString .= 'ORDER BY';
    }
    else{
      $this->queryString .= ',';
    }
    $this->queryString .= ' ';
    $this->queryString .= $row.' '.strtoupper($order);
    return $this;
  }

    // Function for limiting result and setting pagination
  public function limit($limit=15)
  {
    $page = isset($_GET["page"]) ? intval($_GET["page"]) : 1; 
    $calc = $limit * $page;
    $start = $calc - $limit;
    $limit = intval($limit);
    $this->paginate = ' LIMIT '.$start.', '.$limit;
    return $this;
  }

    // Values for insert
  public function data($values= array())
  {
    if(count($values) > 0){
      $rows = ''; $parameters = ''; $gap = '';
      foreach ($values as $key => $value) {
          $rows .= $gap.$key;
          $parameters .= $gap.':'.$key;
          $this->execArray[':'.$key] = $value;
          $gap = ', ';
      }
      $check = $this->checkColumn('created_at');
      if($check){
        $this->queryString .= ' ('.$rows.', created_at) VALUES ('.$parameters.', :created_at)';
        $this->execArray[':created_at'] = date("Y-m-d H:i:s", time());
      }
      else{
        $this->queryString .= ' ('.$rows.') VALUES ('.$parameters.')';
      }
    }
    return $this;
  }

    // Values for update
  public function set($values= array())
  {
    $this->queryString .= 'SET ';
    if(count($values) > 0){
      $gap = '';
      foreach ($values as $key => $value) {
          $this->queryString .= $gap.$key.' = :'.$key;
          $this->execArray[':'.$key] = $value;
          $gap = ', ';
      }
      $check = $this->checkColumn('updated_at');
      if($check){
        $this->queryString .= $gap.'updated_at = :updated_at';
        $this->execArray[':updated_at'] = date("Y-m-d H:i:s", time());
      }
    }
    $this->queryString .= ' ';
    return $this;
  }

    // Raw query from database
  public function get($raw='')
  {
    $pdo = $this->getInstance();
    $query = $pdo->prepare($raw);    
    $query->execute();
    $data = $query->fetchAll();
    return $data;
  }

    // Read from database
  public function read()
  {
    $pdo = $this->getInstance();
    $check = $this->checkColumn('deleted_at');
    if($check){
      $this->queryString .= ' ';
      $deleted_at = 'WHERE deleted_at IS NULL';
      if(preg_match('/\bWHERE\b/', $this->queryString)) {
        $deleted_at = 'AND deleted_at IS NULL';
      }
      $this->queryString .= $deleted_at;
    }
    $query = $pdo->prepare('SELECT * FROM '.$this->table.' '.$this->queryString.' '.$this->paginate);    
    $query->execute($this->execArray);
    $data = $query->fetchAll();
    return $data;
  }

    // Calculate total result
  public function total()
  {
    $pdo = $this->getInstance();
    $query = 'SELECT * FROM '.$this->table.' '.$this->queryString;
    $total = $pdo->prepare($query);
    $total->execute($this->execArray);
    $this->total = $total->rowCount();
    return $this->total;
  }

    // Store in database
  public function store()
  {
    $pdo = $this->getInstance();
    $query = $pdo->prepare('INSERT INTO '.$this->table.' '.$this->queryString);    
    $status = $query->execute($this->execArray);
    return $status;
  }

    // Update database column
  public function update()
  {
    $pdo = $this->getInstance();
    $query = $pdo->prepare('UPDATE '.$this->table.' '.$this->queryString);    
    $status = $query->execute($this->execArray);
    return $status;
  }

    // delete database column
  public function delete()
  {
    $pdo = $this->getInstance();
    $check = $this->checkColumn('deleted_at');
    if($check){
      $query = $pdo->prepare('UPDATE '.$this->table.' SET deleted_at = :deleted_at '.$this->queryString);
      $this->execArray[':deleted_at'] = date("Y-m-d H:i:s", time());
    } 
    else {
      $query = $pdo->prepare('DELETE FROM '.$this->table.' '.$this->queryString);
    }
    $status = $query->execute($this->execArray);
    return $status;
  }

    // Create pagination
  public function pagination(){

    $total = $this->total();

    $limit = explode(" ", $this->paginate);  

    $perpage = intval($limit[count($limit)-1]);

    $page = isset($_GET["page"]) ? intval($_GET["page"]) : 1; 

    $url = strpos($_SERVER['REQUEST_URI'], '&page') !== false ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page')) : $_SERVER['REQUEST_URI'];

    $totalPages = ceil($total / $perpage);
    
    $xml = simplexml_load_file("resources/markups/pagination.xml") or die("Error: &quot;pagination.xml&quot; not found! This file is required for parsing pagination classes. Please create an &quot;pagination.xml&quot; file in the &quot;resources > markup&quot; folder containing markup for &quotnav&quot;, &quot;ul&quot;, &quot;li&quot;, and &quot;a&quot; tags!");

    $nav_class = $xml->nav;
    $ul_class = $xml->ul;
    $li_class = $xml->li;
    $a_class = $xml->a;

    $pagination = "<nav class='$nav_class'><ul class='$ul_class'>";
    
    if($page > 1 ){
      $pagination .= "<li>
                        <a href='$url&page=1' class='$a_class'>
                          |<
                        </a>
                      </li>";
    }
  
    if($page <=1 ){
      $pagination .= "<li class='disabled'>
                        <a href='javascript:void(0);'>
                          Previous
                        </a>
                      </li>";
    }
    else{
      $j = $page - 1;
      $pagination .= "<li>
                        <a href='$url&page=$j' class='$a_class'>
                          Previous
                        </a>
                      </li>";
    }
  
    if ($totalPages >=1 && $page <= $totalPages){
      $range = 2;
      $limit = $range+1;
      $pagination .= "";

      if ($page > $limit){ 
        $pagination .= "<li>
                          <a href='$url&page=1' class='$a_class'>1</a>
                        </li>
                        <li class='disabled'>
                          <a href = 'javascript:void(0);'>...</a>
                        </li>";
      }

      for($i= ($page-$range); $i <(($page + $range)  + 1); $i++){
        if (($i > 0) && ($i <= $totalPages)){
          if($i<>$page){
            $pagination .= "<li>
                              <a href='$url&page=$i' class='$a_class'>$i</a>
                            </li>";
          }
          else{
            $pagination .= "<li class='$li_class'>
                              <a href='javascript:void(0);'>$i</a>
                            </li>";
          }       
        }
      }

      if ($page <= $totalPages - $limit){ 
        $pagination .= "<li class='disabled'>
                          <a href = 'javascript:void(0);'>...</a>
                        </li>
                        <li> 
                          <a href='$url&page=" .$totalPages." ' class='$a_class'>$totalPages</a>
                        </li>"; 
      }
    } 

    if($page == $totalPages ){
      $pagination .= "<li class='disabled'>
                        <a href='javascript:void(0);'>
                            Next
                        </a>
                      </li>";
    }
    else{
      $j = $page + 1;
      $pagination .= "<li>
                        <a href='$url&page=$j' class='$a_class'>
                            Next
                        </a>
                     </li>";
    }

    if($page < $totalPages ){ 
      $pagination .= "<li>
                        <a href='$url&page=" .$totalPages." ' class='$a_class'>
                          >|
                        </a>
                      </li>"; 
    }

    $pagination .= "</ul></nav>";

    return $pagination;
    
  }

}
  
?>