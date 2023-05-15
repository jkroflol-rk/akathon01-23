<?php
    session_start();
    include("./conn/func.php");

    require_once("./functions/functions.php");
    
    // Get the submitted department number
    $firstname = sanitise_input($_POST['fname']);
    $lastname = sanitise_input($_POST['lname']);
    $email = sanitise_input($_POST['email']);
    $phone = sanitise_input($_POST['phone']);
    $currentpass = sanitise_input($_POST['password']);
    $newpass = sanitise_input($_POST['newpassword']);
    $retypepass = sanitise_input($_POST['repassword']);
    $finalpass = $_SESSION['row']->password;
    if (($currentpass == $_SESSION['row']->password)){
        if ($newpass == $retypepass){
            $finalpass = $retypepass;
        }
    }

    
    
    $rdata = [
        "firstname" => $firstname,
        "lastname" => $lastname,
        "email" => $email,
        "phone" => $phone,
        "password" => $finalpass
    ];
    
    $response = updateData("users", $rdata, $_SESSION['userid']);
    
    echo $response;
    $url = "https://b81155ba-05ce-415b-9ca4-b83d935e46a6-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/users/rows/";
    $token = "AstraCS:PXhWiFwCPFWfmLXqOGtkOlCU:ef2043b13fcc33dd3e63368eabf3a4379cf561fda6dec8ae2490832acde2ab39";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Accept: application/json",
        "X-Cassandra-Token: $token"
    ));
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response);
    foreach ($data->data as $row) {
        if ($row->id == $_SESSION['userid']){
            $_SESSION['row'] = $row;
        }
    }
    header('Location: dashboard.php');
?>