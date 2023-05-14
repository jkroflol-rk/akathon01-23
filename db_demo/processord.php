<?php
    session_start();
    $errors = array();
    require_once("./functions/functions.php");

    require_once("settings.php");
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if ($conn) {
        $new_table = file_get_contents("./functions/orderdb.sql");
        if (mysqli_multi_query($conn, $new_table)) {
            do {
                // advance to the next result set
                if ($result = mysqli_store_result($conn)) {
                    mysqli_free_result($result);
                }
            } while (mysqli_next_result($conn));
        }
    }

    // Validate name and save to local variable
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
    

    // Validate lastname and save to local variable
    if (isset($_POST["lastname"]) && $_POST['lastname'] != "") {
        $lastname = sanitise_input($_POST["lastname"]);

        if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
            $errors["lastname"] =  "Only alpha letters allowed in your last name(no spaces).";
        } else if (strlen($lastname) > 25) {
            $errors["lastname"] =  "Last Name is limited to 25 characters.";
        }
    } else {
        $errors["lastname"] = "Please enter your last name";
    }


    // Validate Email
    if (isset($_POST["email"])) {
        $email = sanitise_input($_POST["email"]);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL); // Remove illegal characters

        if ($email == "") {
            $errors["email"] =  "You must enter your email.";
        } else if ((filter_var($email, FILTER_VALIDATE_EMAIL)) == false) {
            $errors["email"] =  "Invalid email address.";
        }
    } else {
        $errors["email"] = "Please enter your email";
    }


    // Validate address
    if (isset($_POST["address"]) && $_POST['address'] != "") {
        $address = sanitise_input($_POST["address"]);

        if (!preg_match("/^[A-Za-z0-9'\.\-\s\,\/]*$/", $address)) {
            $errors["address"] =  "Only Characters such as ['A-Z', 'a-z', '0-9', '.', '-', '/'] are allowed for address.";
        } else if (strlen($address) > 40) {
            $errors["address"] =  "address is limited to 40 characters.";
        }
    } else {
        $errors["address"] = "Please enter your address";
    }




    //  Validate state
    if (isset($_POST["state"]) && $_POST["state"] != "" && $_POST["state"] != "--Please select an option--") {
        $state = sanitise_input($_POST["state"]);
    } else {
        $errors["state"] =  "You must choose state.";
    }



    //Validate Postcode
    if (isset($_POST["postcode"]) && $_POST['postcode'] != "") {
        $postcode = sanitise_input($_POST["postcode"]);

        if (!preg_match("/^[0-9]*$/", $postcode)) {
            $errors["postcode"] =   "Postcode only accepts integers.";
        } else if (strlen($postcode) != 4) {
            $errors["postcode"] =  "Invalid Postcode(4 digits).";
        }
    } else {
        $errors["postcode"] = "Please enter your postcode";
    }


    //validate phone
    if (isset($_POST["phone"]) && $_POST['phone'] != "") {
        $phone = sanitise_input($_POST["phone"]);

        if (!preg_match("/^[0-9]*$/", $phone)) {
            $errors['phone'] = "Phone number is not a valid phone number.";
        } else if (strlen($phone) > 10) {
            $errors['phone'] = "Phone number is not within the legal range(10 digits).";
        }
    } else {
        $errors["phone"] = "Please enter your phone";
    }


    //validate prefer contact
    if (isset($_POST["contact"]) && $_POST["contact"] !="") {
        $contact = sanitise_input($_POST["contact"]);
    } else {
        $errors["contact"] = "Please select a contact method";
    }

    // Validate selection from keyboard product
    if (isset($_POST["keyboard_selection"]) && $_POST["keyboard_selection"] !="") {
        $kb = sanitise_input($_POST["keyboard_selection"]);
    } else {
        $errors["keyboard_selection"] = "Please select a keyboard";
    }

    // Validate selection from mouse product
    if (isset($_POST["mouse_selection"]) && $_POST["mouse_selection"] !="") {
        $mouse = sanitise_input($_POST["mouse_selection"]);
    } else {
        $errors["mouse_selection"] = "Please select a mouse";
    }

    // Validate quantity
    if (isset($_POST["pc_numbers"]) && $_POST["pc_numbers"] !="") {
        $pc_numbers = sanitise_input($_POST["pc_numbers"]);
    } else {
        $errors["pc_numbers"] = "Please input a valid quantity";
    }

    // validate Credit Card Input
    if (isset($_POST["cardType"])&&$_POST["cardType"]!="") {
        $cardtype = sanitise_input($_POST["cardType"]);
    } else {
        $errors["cardType"] = "Please choose your credit card type";
    }

    if (isset($_POST["cardName"]) && $_POST['cardName'] != "") {
        $cardname = sanitise_input($_POST["cardName"]);
    } else {
        $errors["cardName"] = "Please enter your credit card name";
    }

    if (isset($_POST["cardNumber"]) && $_POST['cardNumber'] != "") {
        $cardNum = sanitise_input($_POST["cardNumber"]);
        $cardNum = preg_replace('/\s+/', '', $cardNum);
        $first_num = $cardNum[0];
        $sec_num = $cardNum[1];
        if ($cardNum == "") {
            $errors['cardNum'] = "You must enter your Credit Card number.";
        } else if (!preg_match("/^[0-9]*$/", $cardNum)) {
            $errors['cardNum'] = "Credit Card number only accepts integers.";
        } else if ($cardtype == "visa") {
            // Visa should start with 4 and be 16 digits long
            if ($first_num != "4") {
                $errors['cardNum'] = "Invalid card number (must start with 4).";
            } else if (strlen($cardNum) != 16) {
                $errors['cardNum'] = "Invalid card number (must be 16 digits).";
            }
        } else if ($cardtype == "mastercard") {
            // Mastercard should start with 51-55 and be 16 digits long
            if ($first_num != "5") {
                $errors['cardNum'] = "Invalid card number (must start with 51-55).";
            } else if (($sec_num < "1" || $sec_num > "5")) {
                $errors['cardNum'] = "Invalid card number (must start with 51-55).";
            } else if (strlen($cardNum) != 16) {
                $errors['cardNum'] = "Invalid card number (must be 16 digits).";
            }
        } else if ($cardtype == "americanExpress") {
            // American express should start with 34/37 and be 15 digits long
            if (strlen($cardNum) != 15) {
                $errors['cardNum'] = "Invalid card number (must be 15 digits).";
            } else if ($first_num != "3" || ($sec_num != "4" || $sec_num != 4)) {
                $errors['cardNum'] = "Invalid card number (must start with 34/37).";
            }
        }
    } else {
        $errors["cardNum"] = "Please enter your credit card number";
    }

    if (isset($_POST["expmonth"]) && $_POST['expmonth'] != "") {
        $expmonth = sanitise_input($_POST["expmonth"]);
    } else {
        $errors["expmonth"] = "Please enter your credit card expiry month";
    }

    if (isset($_POST["expyear"]) && $_POST['expyear'] != "") {
        $expyear = sanitise_input($_POST["expyear"]);
    } else {
        $errors["expyear"] = "Please enter your credit card expiry year";
    }

    //Validate Expiry Date 
    if (array_key_exists("expmonth", $errors) == false && array_key_exists("expmonth", $errors) == false) {
        if ($expmonth <=  date("m") && $expyear <= date("y")) {
            $errors['expmonth'] = "Card is expired. Try another one.";
            $errors['expyear'] = "Card is expired. Try another one.";
        } else {
            //Show expiry as MM/YY
            $exp_date = "$expmonth/$expyear";
        }
    }

    if (isset($_POST["cardCVV"]) != "") {
        $cvv = sanitise_input($_POST["cardCVV"]);
        if (!preg_match("/^[0-9]*$/", $cvv)) {
            $errors['cvv'] = "Credit Card CVV only accepts integers.";
        } else if (strlen($cvv) != 3) {
            $errors['cvv'] = "Invalid Card CVV (must be 3 digits).";
        }
    } else {
        $errors["cvv"] = "Please enter your credit card CVV";
    }

    // Recall pcid from session
    $pcid = $_SESSION['pc_id'];

    // save gotten data into an array, then save to session for further use
    $values = array(
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'phone' => $phone,
        'state' => $state,
        'address' => $address,
        'postcode' => $postcode,
        'contact' => $contact,
        'cardtype'=> $cardtype,
        'cardname'=> $cardname,
        'cardnum'=>$cardNum,
        'expmonth'=>$expmonth,
        'expyear'=>$expyear,
        'cardcvv'=>$cvv,
        'pc_numbers' => $pc_numbers,
        'kb' => $kb,
        'mouse' => $mouse,
        'pcid' => $pcid,
    );

    $_SESSION['values'] = $values;
    
    //If any errors, redirect to fix order
    if (empty($errors) == false) {
        $_SESSION["errors"] = $errors;
        header("location: fix_order.php");
        return;
    } else {
        if (!$conn) {
            echo "<p>Database connection failure</p>";
        } else {
            //Carculate total price and fetching data from db 
            $res = $conn->query("SELECT pcprice,pcname FROM pcdb WHERE pc ='$pcid'");
            $pc_price = mysqli_fetch_assoc($res);
            $res = $conn->query("SELECT mouseprice,mousename FROM mousedb WHERE mouse = '$mouse'");
            $mouse_price = mysqli_fetch_assoc($res);
            $res = $conn->query("SELECT kbprice,kbname FROM kbdb WHERE kb = '$kb'");
            $kb_price = mysqli_fetch_assoc($res);
            $total_price = (intval($pc_price['pcprice']) + intval($mouse_price['mouseprice']) + intval($kb_price['kbprice'])) * $values['pc_numbers'];
            $_SESSION['totalprice'] = $total_price;
            
            // save order to database if all information are correct
            $query = "INSERT INTO orderdb (firstname, lastname, email, address, state, post, phone, prefercont,pc , mouse, kb, quantity,order_cost ,card, cardname, expmonth, expyear, cvv) VALUES 
                    ('$firstname', '$lastname', '$email', '$address', '$state', '$postcode', '$phone','$contact','$pcid','$mouse', '$kb','$pc_numbers','$total_price','$cardtype', '$cardname', '$expmonth', '$expyear', '$cvv')";
            $result = mysqli_query($conn, $query);
            $query = "SELECT order_id, order_status, order_time FROM orderdb WHERE firstname = '$firstname' AND lastname = '$lastname' AND email = '$email' AND address = '$address' AND state = '$state' AND post = '$postcode' AND phone = '$phone' AND prefercont = '$contact' AND pc = '$pcid' AND mouse = '$mouse' AND kb = '$kb' AND quantity = '$pc_numbers' AND order_cost = '$total_price'";
            $result = mysqli_query($conn, $query);
            $order_info = mysqli_fetch_assoc($result);

            // save receipt infomation to receipt page
            $receipt = array(
                'pcprice'=>$pc_price['pcprice'],
                'mouseprice'=>$mouse_price['mouseprice'],
                'kbprice'=>$kb_price['kbprice'],
                'pcname'=>$pc_price['pcname'],
                'mousename'=>$mouse_price['mousename'],
                'kbname'=>$kb_price['kbname'],
                'totalprice'=>$total_price,
                'order_id'=>$order_info['order_id'],
                'order_status'=>$order_info['order_status'],
                'order_time'=>$order_info['order_time'],
            );
            $_SESSION['receipt']=$receipt;
            echo $query;
            if (!$result) {
                echo "<p>Failed</p>";
            } else {
                header('location: ./receipt.php');
            }
        }
    }
?>
