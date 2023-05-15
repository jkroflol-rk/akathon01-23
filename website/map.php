<?php 
session_start();

include("./conn/func.php");
// Get the submitted department number
$vnum = $_POST['departments'];

// Get the submitted names and hosts as arrays
$name = $_POST['name'];
$host = $_POST['host'];


$output = array();

for ($i = 0; $i < $vnum; $i++) {
  $item = array('key' => $name[$i], 'value' => $host[$i]);
  array_push($output, $item);
}

$rdata = [
    "vlan" => "$vnum",
    "vlans" => $output
];

$response = updateData("users", $rdata, $_SESSION['userid']);

echo $response;

$op = convertVlan($rdata);

echo $op;

header('Location: ./cryptoscam.php');
?>
