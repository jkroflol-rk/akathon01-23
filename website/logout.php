<?php 
    session_start();
    if ((isset($_SESSION['authenticated']) && $_SESSION['authenticated']) || (isset($_SESSION['admin']) && $_SESSION['admin'])) {
        session_unset();
        //unset session
        session_destroy();
        //destroy session
        header("Location: ./index.php");
        //after logout headback to login page

    }else{
        header('Location: ./login.php');
    }
?>