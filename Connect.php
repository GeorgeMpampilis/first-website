<?php
  $host = 'localhost';
  $dbname = 'comments';
  $dbuser = 'root';   
  $dbpass = '';    
  
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;", $dbuser, $dbpass); 
  } catch (PDOException $e) {
      print "Database Error: " . $e->getMessage() . "<br/>";
      die();
    }
?>