<?php
    session_start();//to logout, start the session
    session_unset();//unset the session
    session_destroy();//then destroy the session
    header('location:../index.php');//redirect user to index page
?>