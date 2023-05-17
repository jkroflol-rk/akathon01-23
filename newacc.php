<?php
    session_start();
    include("./conn/func.php");

    require_once("./functions/functions.php");
    $data = getData("users");
    $enable_regis = true;
    
    // Get the submitted department number
    $firstname = sanitise_input($_POST['fname']);
    $lastname = sanitise_input($_POST['lname']);
    $email = sanitise_input($_POST['email']);
    $phone = sanitise_input($_POST['phone']);
    $username = sanitise_input($_POST['username']);
    $password = sanitise_input($_POST['password']);
    
    $timestamp = gmdate('Y-m-d\TH:i:s\Z');
    
    $rdata = [
        "id" => uuid(), 
        "admin" => false, 
        "email" => $email,
        "firstname" => $firstname,
        "lastname" => $lastname,
        "order_time" => $timestamp,
        "password" => $password,
        "phone" => $phone,
        "username" => $username
    ];
    foreach ($data->data as $row) {
        if(($row->username == $username)){
            $enable_regis = false;
        }
    }
    if($enable_regis == true){
        $response = postData("users", $rdata);
        echo $response;
    
        $noti = "Sign up successful! Please login!";
    
        // Encode the notification message for URL
        $encodedNoti = urlencode($noti);
        
        // Redirect to login.php with the notification message as a query parameter
        header("Location: ./login.php?noti=$encodedNoti");

    }else{
        $errormsg = urlencode("Username has already been used");
        header("Location: ./registration.php?noti=$errormsg");
    }
?>

