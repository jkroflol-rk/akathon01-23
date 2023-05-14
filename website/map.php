<?php 
include("./conn/func.php");
// Get the submitted department number
$department_num = $_POST['departments'];

// Get the submitted names and hosts as arrays
$name = $_POST['name'];
$host = $_POST['host'];

$output = array();

for ($i = 0; $i < $department_num; $i++) {
  $item = array('key' => $name[$i], 'value' => $host[$i]);
  array_push($output, $item);
}

$rdata = [
    "vlans" => $output
];

$response = updateData("users", $rdata, "eb0b3769-9bec-47dc-9ef9-d1e1bbced599");

echo $response;
?>