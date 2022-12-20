<?php
    require "../includes/header.php";//require the common header file
    require "../config/config.php";//require the config file for database connections
    
    if(isset($_GET['delete_id'])){//check if delete_id is present, we cannot delete without the delete_id
        $delID = $_GET['delete_id'];//capture the delete_id
        
        $select=$conn->query("SELECT * FROM posts WHERE id ='$delID'");//SQL select query, to select what we want to delete
        $select->execute();//execute the select query
        $posts=$select->fetch(PDO::FETCH_OBJ);//capture data from query
        
        if($_SESSION['user_id'] != $posts->user_id){//check if the logged in user_id is equal to the post's delete_id
            header("location:../index.php");//if not, redirect user to index page
        }else{//if the logged in user_id is equal to the post's delete_id
            unlink("images/".$posts->img."");//delete the post's image from our directory
        
            $delete=$conn->prepare("DELETE FROM posts WHERE id = :id");//SQL query to delete the post
            $delete->execute([//bind parameters to the query temp variables
            ':id'=>$delID
            ]);
            header("location:../index.php");//after deletion, redirect user to index page
        }

        
        
    }
    

?>