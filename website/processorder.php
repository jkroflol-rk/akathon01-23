<?php
    session_start();
    if (isset($_POST["firstname"]) && $_POST['firstname'] != "") {
        $firstname = sanitise_input($_POST["firstname"]);

    if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
        $errors["firstname"] = "Only alpha letters allowed in your first name(no spaces).";
    } else if (strlen($firstname) > 25) {
        $errors["firstname"] = "First Name is limited to 25 characters.";
    }
    } else {
        $errors["firstname"] = "Please enter your first name";
    }

?>