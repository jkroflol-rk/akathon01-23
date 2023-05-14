<?php

include('./conn/func.php');

$data = getData("users");

$timestamp = new DateTime('now', new DateTimeZone('Asia/Bangkok'));
$cql_timestamp = $timestamp->format('Y-m-d\TH:i:sP');

echo $cql_timestamp; // Output: 2023-05-12T14:30:15+07:00

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