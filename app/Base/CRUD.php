<?php
namespace App\Library;

final class CRUD extends Library {

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
    private static function inputString($rows = ''){
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
    private static function parameterArray($rows = '', $inputs= '', $conditionRows = '', $conditionInputs= ''){
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
    private static function generateUpdateString($rows = ''){
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
    private static function generateCondition($conditionRows=''){
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
    public static function read($tablename='', $paginate='', $conditionRows = '', $conditionInputs= '', $extra=''){
        if(!empty($tablename)){
          $pdo = self::getInstance();
          $generateQuery = 'SELECT * FROM '.$tablename.' '.self::generateCondition($conditionRows).$extra;

            // check if the query will paginate the data or not
          if(is_array($paginate) && array_key_exists('perpage',$paginate) && array_key_exists('page',$paginate) && array_key_exists('start',$paginate)){
        
            $perpage =  intval($paginate['perpage']); 
            $page =  intval($paginate['page']); 
            $start =  intval($paginate['start']);

              // Query for pagination
            $countQuery =  $pdo->prepare($generateQuery);
            $countQuery->execute(self::parameterArray($conditionRows, $conditionInputs)); 
            $total = $countQuery->rowCount();
            $pagination = self::paginate($total, $perpage, $page);

              // Query for getting data
            $dataQuery = $pdo->prepare($generateQuery." LIMIT $start, $perpage");
            $dataQuery->execute(self::parameterArray($conditionRows, $conditionInputs));
            $data=$dataQuery->fetchAll();
            return array('data'=>$data, 'pagination'=>$pagination);
          }
          else{
            $query = $pdo->prepare($generateQuery);
            $query->execute(self::parameterArray($conditionRows, $conditionInputs));
            $data=$query->fetchAll();
            return $data;
          }
        }
    }

      // Function for inserting data
    public static function create($tablename='', $rows='', $inputs=''){
      if(!empty($tablename) && is_array($rows) && is_array($inputs) && count($rows) == count($inputs)){
        $pdo = self::getInstance();

          // Creating the query command
        $generateQuery = 'INSERT INTO '.$tablename.' ('.self::rowString($rows).') VALUES ('.self::inputString($rows).')'; 
        //return $generateQuery;
          // Execute Query
        $query = $pdo->prepare($generateQuery);        
        $status = $query->execute(self::parameterArray($rows, $inputs));
    
        // Return Status
        return $status;
      }
    }

      // Function for updating data
    public static function update($tablename='', $rows='', $inputs='', $conditionRows = '', $conditionInputs= '', $extra=''){
      if(!empty($tablename)){
        $pdo = Database::getInstance();

          // Creating the query command
        $generateQuery = 'UPDATE '.$tablename.' SET '.self::generateUpdateString($rows).self::generateCondition($conditionRows).$extra; 

          // Execute Query
        $query = $pdo->prepare($generateQuery);        
        $status = $query->execute(self::parameterArray($rows, $inputs, $conditionRows, $conditionInputs));
    
        // Return Status
        return $status;
      }
    }

      // Function for deleting data
    public static function delete($tablename='', $conditionRows = '', $conditionInputs= '', $extra=''){
      if(!empty($tablename)){
        $pdo = Database::getInstance();

          // Creating the query command
        $generateQuery = 'DELETE FROM '.$tablename.self::generateCondition($conditionRows).$extra; 

         // Execute Query
        $deleteQuery = $pdo->prepare($generateQuery);
        $status = $query->execute(self::parameterArray($conditionRows, $conditionInputs));
    
          // Return Status
        return $status;
      }
    }



}

?>