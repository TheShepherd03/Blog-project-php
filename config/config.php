<?php 
try {
$dbName="blog-project";//database name
$user="root";//database username
$pass="";//database password
$conn=new PDO("mysql:host=localhost;dbname=$dbName",$user,$pass);//establish a database connection using the given credentials
    
} catch (PDOException $e) {//if we cannot connect to the database, print out the error message
   echo $e->getMessage();
}



?>