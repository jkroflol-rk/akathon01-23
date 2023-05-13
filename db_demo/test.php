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

$data = json_decode($response);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Display Users</title>
  <link rel="stylesheet" type="text/css" href="test.css">
</head>
<body>
  <h1>Users</h1>
  <table id="userstable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Firstname</th>
        <th>Lastname</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data->data as $row): ?>
        <tr>
          <td><?= $row->id ?></td>
          <td><?= $row->email ?></td>
          <td><?= $row->firstname ?></td>
          <td><?= $row->lastname ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>