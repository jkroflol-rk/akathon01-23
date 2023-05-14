<?php
include('./conn/func.php');

$firstname = $_POST['firstname'];
$email = $_POST['email'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$id = uuid();

$data = [
    "id" => $id,
    "firstname" => $firstname,
    "email" => $email,
    "lastname" => $lastname,
    "phone" => $phone
];

$answer = postData("users", $data);

echo $answer;
?>