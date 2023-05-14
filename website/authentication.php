<?php
    session_start();

    require_once("./functions/functions.php");

    $url = "https://b81155ba-05ce-415b-9ca4-b83d935e46a6-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/users/rows";
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
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = sanitise_input($_POST["username"]);
        $password = sanitise_input($_POST["password"]);
    }
?>

<?php 
  foreach ($data->data as $row) {
    if (($password == $row->password) && ($username == $row->username && ($row->admin == "true"))) {
      header('Location: admin.php');
      $_SESSION['admin'] = true;
      $_SESSION['userid'] = $row->id;
      exit();
    } else if (($password == $row->password) && ($username == $row->username)) {
      header('Location: dashboard.php');
      $_SESSION['authenticated'] = true;
      $_SESSION['userid'] = $row->id;
      exit();
    }else{
      header('Location: login.php');
    }
  }
?>