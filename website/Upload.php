<?php
    session_start();
    require_once("./functions/functions.php");
    $department_num = $_POST['departments'];

    // Get the submitted names and hosts as arrays
    $name = $_POST['name'];
    $host = $_POST['host'];

    $data = array();
    for ($i = 0; $i < $department_num; $i++) {
        $data[$name[$i]] = $host[$i];
    }

    $json = json_encode($data);
    echo $json;
?>