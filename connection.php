<?php 
   function connection (){
      define("host", "localhost");
      define("username", "root");
      define("password", "12345");
      define("database", "record_system");

      $con = new mysqli(host, username, password, database);

      if ($con->connect_error){
         echo $con->connect_erro;
      } else {
         return $con;
      }
   }

?>