<?php

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
$pass = "jane.doe@example.com";
echo $pass;

$data = json_decode($response);
$username = $_POST["username"];
$password = $_POST["password"];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Display Users</title>
  <link rel="stylesheet" type="text/css" href="test.css">
</head>
<body>
  <h1>Users</h1>
  <form action="admin.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username">
    <label for="password">Password:</label>
    <input type="text" name="password">
    <input type="submit" value="Submit">
  </form>
  <table id="userstable">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Departments</th>
        <th>Users</th>
        
      </tr>
      <br>
    </thead>
    <tbody>
      <?php foreach ($data->data as $row): ?>
        <tr>
          <td><?= $row->id ?></td>
          <td><?= $row->email ?></td>
          <td><?= $row->firstname ?></td>
          <td><?= $row->lastname ?></td>
          <td><?= $row->username ?></td>
          <td><?= $row->password ?></td>

          <?php
            if (($password == $row->password) && ($username == $row->username && ($row->admin == "true"))){
              header('Location: https://rt-kc.github.io/akathon01-23/website/index.html');
              
            }else if (($password == $row->password) && ($username == $row->username)){
              echo $row->username;
              header('Location: http://www.example.com/');
            }
            
          ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>

