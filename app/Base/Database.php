<?php
  
  namespace App\Library;
  use PDO;
  
  class Database {
    private static $instance = NULL;
    private static $bindInt = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      try{
        if (!isset(self::$instance)) {
          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
          self::$instance = new PDO('mysql:host=localhost;dbname=ecommerce', 'root', '1234', $pdo_options);
        }
        return self::$instance;        
      }
      catch (PDOException $e) {
          echo 'Error: ' . $e->getMessage();
          die();
      }
    }

    public static function bindInteger() {
      try{
        if (!isset(self::$bindInt)) {
          self::$bindInt = PDO::PARAM_INT;
        }
        return self::$bindInt;
      }
      catch (PDOException $e) {
          echo 'Error: ' . $e->getMessage();
          die();
      }
    }
  }
  
?>