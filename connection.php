<?php
 $db='travelers'; $user='root'; $pass='';
 // PDO staat voor PHP Data Objects
 try
 {
   $conn = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8',$user,'',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
 }
 catch(Exception $e)
 {
   // als de connectie niet lukt 
   $conn = false;
     echo ' '.$e->getMessage();
 }
?>
