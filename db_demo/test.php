<?php

$url = "https://d7a28deb-6666-4314-9584-01ed5d2c5b69-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/users/rows";
$token = "AstraCS:nMFywxEBGfZHlpXqBKAbtbQn:74cfd0b1913e2033cc672e3201d56a03f0641bbd6d82f8fca259463b46915410";

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
        <th>Name</th>
        <th>Email</th>
        <th>Departments</th>
        <th>Users</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data->data as $row): ?>
        <tr>
          <td><?= $row->name ?></td>
          <td><?= $row->email ?></td>
          <td><?= $row->departments ?></td>
          <td><?= $row->users ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>