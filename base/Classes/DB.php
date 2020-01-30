<?php
  
namespace Base;
use PDO;
  
class DB
{

    // Declaring database query variables
  private $bindInt;
  private $instance;
  private $table;
  private $queryString;
  private $orderby;
  private $paginate;
  private $lastId;
  private $total;
  private $sqlQuery;
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
    $this->orderby = '';
    $this->paginate = '';
    $this->lastId = '';
    $this->total = '';
    $this->sqlQuery = '';
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
    // Destruct Variables
  private function destroy()
  {
    $this->queryString = '';
    $this->orderby = '';
    $this->execArray = array();
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
    if(!empty($row) && !empty($op)){
      $this->queryString .= ' ';
      $this->queryString .= $row.' '.$op.' :'.$row;
      $this->queryString .= ' ';
      if(empty($value)){
        $this->execArray[':'.$row] =  ' ';
      }
      else{
        $this->execArray[':'.$row] =  $value;
      }
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

    // Including Condition String
  public function condition($str = '')
  {
    $this->queryString .= ' '.$str.' ';
    return $this;
  }

    // Including WHERE conditions
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
    if(strpos($this->orderby, 'ORDER BY') === false){
      $this->orderby .= 'ORDER BY ';
    }
    else{
      $this->orderby .= ', ';
    }
    $this->orderby .= $row.' '.strtoupper($order);
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

    // Get data from raw query from database
  public function get($raw='')
  {
    $pdo = $this->getInstance();
    $query = $pdo->prepare($raw);    
    $query->execute();
    $data = $query->fetchAll();
    return $data;
  }

    // Insert/Update/Delete from raw query in database
  public function write($raw='')
  {
    $pdo = $this->getInstance();
    $query = $pdo->prepare($raw);    
    $status = $query->execute();
    return $status;
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
    $this->sqlQuery = 'SELECT * FROM '.$this->table.' '.$this->queryString.' '.$this->orderby.' '.$this->paginate;
    $query = $pdo->prepare('SELECT * FROM '.$this->table.' '.$this->queryString.' '.$this->orderby.' '.$this->paginate);    
    $query->execute($this->execArray);
    $data = $query->fetchAll();

    $all_data = $pdo->prepare('SELECT * FROM '.$this->table.' '.$this->queryString);
    $all_data->execute($this->execArray);
    $this->total = $all_data->rowCount();

    $this->destroy();
    return $data;
  }

    // Returning total data of last query
  public function getTotal() 
  {
    $total = $this->total;
    $this->total = '';
    return $total;     
  }

    // Checking if exists in deleted
  public function check()
  {
    $pdo = $this->getInstance();
    $this->sqlQuery = 'SELECT * FROM '.$this->table.' '.$this->queryString;
    $query = 'SELECT * FROM '.$this->table.' '.$this->queryString;
    $total = $pdo->prepare($query);
    $total->execute($this->execArray);
    $this->destroy();
    if($total->rowCount() > 0){
      return true;
    }
  }

    // Store in database
  public function create()
  {
    $pdo = $this->getInstance();
    $this->sqlQuery = 'INSERT INTO '.$this->table.' '.$this->queryString;
    $query = $pdo->prepare('INSERT INTO '.$this->table.' '.$this->queryString);    
    $status = $query->execute($this->execArray);
    $this->lastId = $pdo->lastInsertId();
    $this->destroy();
    return $status;
  }

    // Returning ID of last inserted data
  public function getLastId() 
  {
    $id = $this->lastId;
    $this->lastId = '';
    return $id;     
  }

    // Update database column
  public function update()
  {
    $pdo = $this->getInstance();
    $this->sqlQuery = 'UPDATE '.$this->table.' '.$this->queryString;
    $query = $pdo->prepare('UPDATE '.$this->table.' '.$this->queryString);    
    $status = $query->execute($this->execArray); 
    $this->destroy();
    return $status;
  }

    // delete database column
  public function delete()
  {
    $pdo = $this->getInstance();
    $check = $this->checkColumn('deleted_at');
    if($check){
      $this->sqlQuery = 'UPDATE '.$this->table.' SET deleted_at = :deleted_at '.$this->queryString;
      $query = $pdo->prepare('UPDATE '.$this->table.' SET deleted_at = :deleted_at '.$this->queryString);
      $this->execArray[':deleted_at'] = date("Y-m-d H:i:s", time());
    } 
    else {
      $this->sqlQuery = 'DELETE FROM '.$this->table.' '.$this->queryString;
      $query = $pdo->prepare('DELETE FROM '.$this->table.' '.$this->queryString);
    }
    $status = $query->execute($this->execArray);
    $this->destroy();
    return $status;
  }

    // Get Last MySQL command
  public function getLastSQL(){
    return $this->sqlQuery;
  }

    // Create pagination data array
  public function paginationData(){

    $total = $this->getTotal();

    $limit = explode(" ", $this->paginate);  

    $perpage = intval($limit[count($limit)-1]);

    $page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;

    $totalPages = ceil($total / $perpage);

    return array('page' => $page, 'totalPages' => $totalPages);
    
  }

    // function for generating pagination pages
  public function generatePages($page=1, $totalPages=1, $url='javascript:void(0);'){  

    $param = '?page';

    if(count($_GET) > 0){
      $param = strpos($_SERVER['REQUEST_URI'], $param) == false ? '&page' : $param;
      $url = strpos($url, $param) !== false ? substr($url, 0, strpos($url, $param)) : $url;
    }

    $url = $url.$param; 
    
    if (file_exists("resources/markups/pagination.xml")){
      $xml = simplexml_load_file("resources/markups/pagination.xml") or die(logger('ERROR: Can  not load xml file'));
    }
    else{ 
      throw new \Exception("&quot;pagination.xml&quot; not found! This file is required for parsing pagination classes. Please create a &quot;pagination.xml&quot; file in the &quot;resources > markup&quot; folder containing markup for &quotnav&quot;, &quot;ul&quot;, &quot;li&quot;, and &quot;a&quot; tags!");
    }

    $pagination = '<nav class="'.$xml->nav_class.'"><ul class="'.$xml->ul_class.'">';
    
    if($page > 1){
      $pagination .= '<li class="'.$xml->li_class.'">
                        <a class="'.$xml->a_class.'" href="'.$url.'=1">
                          '.$xml->first.'
                        </a>
                      </li>';
    }
  
    if($page <=1){
      $pagination .= '<li class="'.$xml->li_class.' disabled">
                        <a class="'.$xml->a_class.'" href="javascript:void(0);">
                          '.$xml->previous.'
                        </a>
                      </li>';
    }
    else{
      $j = $page - 1;
      $pagination .= '<li class="'.$xml->li_class.'">
                        <a class="'.$xml->a_class.'" href="'.$url.'='.$j.'">
                          '.$xml->previous.'
                        </a>
                      </li>';
    }
  
    if ($totalPages >=1 && $page <= $totalPages){
      $range = 2;
      $limit = $range+1;
      $pagination .= '';

      if ($page > $limit){ 
        $pagination .= '<li class="'.$xml->li_class.'">
                          <a class="'.$xml->a_class.'" href="'.$url.'=1">1</a>
                        </li>
                        <li class="'.$xml->li_class.' disabled">
                          <a class="'.$xml->a_class.'" href = "javascript:void(0);">...</a>
                        </li>';
      }

      for($i= ($page-$range); $i <(($page + $range)  + 1); $i++){
        if (($i > 0) && ($i <= $totalPages)){
          if($i<>$page){
            $pagination .= '<li class="'.$xml->li_class.'">
                              <a class="'.$xml->a_class.'" href="'.$url.'='.$i.'">'.$i.'</a>
                            </li>';
          }
          else{
            $pagination .= '<li class="'.$xml->li_class.' active">
                              <a class="'.$xml->a_class.'" href="javascript:void(0);">'.$i.'</a>
                            </li>';
          }       
        }
      }

      if ($page <= $totalPages - $limit){ 
        $pagination .= '<li class="'.$xml->li_class.' disabled">
                          <a  class="'.$xml->a_class.'" href = "javascript:void(0);">...</a>
                        </li>
                        <li class="'.$xml->li_class.'"> 
                          <a class="'.$xml->a_class.'" href="'.$url.'='.$totalPages.'">'.$totalPages.'</a>
                        </li>'; 
      }
    } 
    if($totalPages == 0 || $page == $totalPages){
      $pagination .= '<li class="'.$xml->li_class.' disabled">
                        <a class="'.$xml->a_class.'" href="javascript:void(0);">
                            '.$xml->next.'
                        </a>
                      </li>';
    }
    else{
      $j = $page + 1;
      $pagination .= '<li class="'.$xml->li_class.'">
                        <a class="'.$xml->a_class.'" href="'.$url.'='.$j.'">
                            '.$xml->next.'
                        </a>
                      </li>';
    }

    if($page < $totalPages){ 
      $pagination .= '<li class="'.$xml->li_class.'">
                        <a class="'.$xml->a_class.'" href="'.$url.'='.$totalPages.'">
                          '.$xml->last.'
                        </a>
                      </li>'; 
    }

    $pagination .= '</ul></nav>';

    return $pagination;
  }

    // Create pagination
  public function pagination(){

    $data = $this->paginationData();

    $pagination = $this->generatePages($data['page'], $data['totalPages'], $_SERVER['REQUEST_URI']);

    return $pagination;
    
  }

}
  
?>