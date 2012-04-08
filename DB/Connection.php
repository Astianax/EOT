<?php

class Connection {
   public $connection;
   public $host="localhost";
   public $user="root";
   public $password="";
   public $database="eotdb";
   public static $instance;
   
   private function __construct(){
       $this->connection = mysql_connect($this->host, $this->user, $this->password);
       mysql_select_db($this->database, $this->connection);
   }
   public static function getInstance(){
       if(!self::$instance){
           self::$instance= new Connection(); 
       }
       return self::$instance;
   }
   
   public function __destruct(){
       mysql_close($this->connection);
   }
   
}

?>
