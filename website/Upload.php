<?php
    session_start();
    require_once("./functions/functions.php");

    function checkprofile(){
        if (isset($_POST["fname"]) && $_POST["fname"])) {
            $username = sanitise_input($_POST["username"]);
            $password = sanitise_input($_POST["password"]);
        }
    }
?>