<?php
include('./conn/func.php');

if (
    isset($_POST['name']) &&
    isset($_POST['port']) &&
    isset($_POST['bandwidth']) &&
    isset($_POST['price']) &&
    isset($_POST['size']) &&
    isset($_POST['weight'])
) {
    $ndata = [
		"id" => uuid(),
        "name" => $_POST['name'],
        "image" => "images/placeholder.png",
        "link" => "https://www.cisco.com/site/us/en/products/networking/switches/index.html",
        "port" => $_POST['port'],
        "bandwidth" => $_POST['bandwidth'],
        "price" => $_POST['price'],
        "size" => $_POST['size'],
        "weight" => $_POST['weight']
	];
	$showndata =  postData("devices", $ndata);
	echo $showndata;
	header('Location: ./admin.php#scroll');
} 

if (isset($_GET['device_id'])) {
	$deleteid = $_GET['device_id'];
	$delete = deleteData("devices", $deleteid);
    echo $delete;
	header('Location: ./admin.php#scroll');
}
?>