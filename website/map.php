<?php 
include('./conn/func.php');
// Get the submitted department number
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

$rdata = [
    "vlans" => $json
];

$response = updateData("users", $rdata, "eb0b3769-9bec-47dc-9ef9-d1e1bbced599");

echo $response;
?>