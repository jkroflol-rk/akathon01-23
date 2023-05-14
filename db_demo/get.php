<?php

include('./conn/func.php');

$data = getData("users");

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