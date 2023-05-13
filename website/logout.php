<?php 
    session_start();

    session_unset();
    //unset session
    session_destroy();
    //destroy session
    header("Location: ./index.php");
    //after logout headback to login page
?>