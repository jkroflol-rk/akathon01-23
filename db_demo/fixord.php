<?php
	// connect to db
	require_once("settings.php");
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
	session_start();
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// get pc name and price from previous pc id
	if (isset($_SESSION['pc_id'])) {
		$pc_id = $_SESSION['pc_id'];
		$result = mysqli_query($conn, "SELECT * FROM pcdb WHERE pc = $pc_id");
		$row = mysqli_fetch_assoc($result);
		$p_name = $row['pcname'];
		$p_price = $row['pcprice'];
	}
	if (!isset($_SESSION['errors']) || !isset($_SESSION['values'])) {
		header('Location: ./index.php'); // Return to index page to prevent directly access from url
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Le Xuan Nhat, Dang Nam Khanh, Duong Quang Thanh">
	<meta name="keyword" content="fix">
	<meta name="description" content="Assignment 2">

	<title>Fix Order Form</title>

	<link href="styles/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&family=Ubuntu:wght@300;400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.css">
</head>

<body>

	<?php include 'includes/header.inc' ?>

	<?php
		require_once("./functions/functions.php");
	?>

	<main class="enq fix">
		<h1>FIX ORDER FORM</h1>
		<form action="process_order.php" method="post" novalidate>
			<div class="form_container">

				<div class="part">
					<fieldset>
						<legend>Customer Information</legend>
						<!-- Call data_fetch function from array to get saved data from previous page, set values of tag to saved data, if errors existed, then
						show error, if not return default blank -->
						<label for="firstname">First Name: </label>
						<input type="text" id="firstname" name="firstname" placeholder="max 25 characters, alphabetical" value="<?= array_data_fetch($_SESSION['values'], 'firstname', "") ?>">
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'firstname', "") ?></p>
						<label for="lastname">Last Name:</label>
						<input type="text" id="lastname" name="lastname" placeholder="max 25 characters, alphabetical" value="<?= array_data_fetch($_SESSION['values'], 'lastname', "") ?>">
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'lastname', "") ?></p>
						<label for="email">Email:</label>
						<input type="email" id="email" name="email" value="<?= array_data_fetch($_SESSION['values'], 'email', "") ?>">
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'email', "") ?></p>
						<label for="address">Street Address:</label>
						<input type="text" id="address" name="address" placeholder="maximum 40 characters" value="<?= array_data_fetch($_SESSION['values'], 'address', "") ?>">
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'address', "") ?></p>
						<label for="state">State:</label>
						<select id="state" name="state">
							<!-- The state should be returned to selected item in selection box -->
							<option value="">--Please select an option--</option>
							<option value="VIC" <?php if ($_SESSION['values']['state'] == "VIC") echo 'selected'; ?>>VIC</option>
							<option value="NSW" <?php if ($_SESSION['values']['state'] == "NSW") echo 'selected'; ?>>NSW</option>
							<option value="QLD" <?php if ($_SESSION['values']['state'] == "QLD") echo 'selected'; ?>>QLD</option>
							<option value="NT" <?php if ($_SESSION['values']['state'] == "NT") echo 'selected'; ?>>NT</option>
							<option value="WA" <?php if ($_SESSION['values']['state'] == "WA") echo 'selected'; ?>>WA</option>
							<option value="SA" <?php if ($_SESSION['values']['state'] == "SA") echo 'selected'; ?>>SA</option>
							<option value="TAS" <?php if ($_SESSION['values']['state'] == "TAS") echo 'selected'; ?>>TAS</option>
							<option value="ACT" <?php if ($_SESSION['values']['state'] == "ACT") echo 'selected'; ?>>ACT</option>
						</select>
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'state', "") ?></p><!-- Return blank value and error code -->
						<label for="postcode">Postcode:</label>
						<input type="text" id="postcode" name="postcode" placeholder="exactly 4 digits" value="<?= array_data_fetch($_SESSION['values'], 'postcode', "") ?>">
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'postcode', "") ?></p>

						<label for="phone">Phone:</label>
						<input type="text" id="phone" name="phone" placeholder="e.g. 0400123456" value="<?= array_data_fetch($_SESSION['values'], 'phone', "") ?>">
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'phone', "") ?></p>

						<label>Preferred Contact:</label>
						<!-- The prefer contact should be returned to selected item in selection box -->
						<label><input type="radio" name="contact" value="email" <?php if ($_SESSION['values']['contact'] == 'email') echo 'checked'; ?>>Email</label>
						<label><input type="radio" name="contact" value="post" <?php if ($_SESSION['values']['contact'] == 'post') echo 'checked'; ?>>Post</label>
						<label><input type="radio" name="contact" value="phone" <?php if ($_SESSION['values']['contact'] == 'phone') echo 'checked'; ?>>Phone</label>
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'contact', "") ?></p>
					</fieldset>
				</div>

				<div class="part">
					<fieldset>
						<legend>Product</legend>
						<p id="pcinfo">Your PC: <?php echo htmlentities($p_name) . " &#40;&#36;" . htmlentities($p_price) . "&#41;"; ?> </p>
						<input type="text" name="pc_id" value="<?= $_SESSION['pc_id'] ?>" hidden>

						<label for="mouse_selection">Select your mouse</label>
						<select name="mouse_selection" id="mouse_selection">
							<!-- The mouse should be returned to selected item in selection box -->
							<option value="">--- Please select your accessory ---</option>
							<option value="1" <?php if ($_SESSION['values']['mouse'] == 1) echo 'selected'; ?>>Logitech G Pro Wireless&#40;&#43;&#36;105&#41;</option>
							<option value="2" <?php if ($_SESSION['values']['mouse'] == 2) echo 'selected'; ?>>Steelseries Rival 3&#40;&#43;&#36;35&#41;</option>
							<option value="3" <?php if ($_SESSION['values']['mouse'] == 3) echo 'selected'; ?>>Razer Deathadder v3 Pro&#40;&#43;&#36;139&#41;</option>
						</select>
						<p class="errMsg"> <?= array_data_fetch($_SESSION['errors'], "mouse_selection", "") ?> </p>

						<label for="keyboard_selection">Select your keyboard</label>
						<select name="keyboard_selection" id="keyboard_selection">
							<!-- The keyboard should be returned to selected item in selection box -->
							<option value="">--- Please select your accessory ---</option>
							<option value="1" <?php if ($_SESSION['values']['kb'] == 1) echo 'selected'; ?>>Razer Blackwidow v4 Pro&#40;&#43;&#36;219&#41;</option>
							<option value="2" <?php if ($_SESSION['values']['kb'] == 2) echo 'selected'; ?>>Steelseries Apex Pro TKL&#40;&#43;&#36;320&#41;</option>
							<option value="3" <?php if ($_SESSION['values']['kb'] == 3) echo 'selected'; ?>>Asus ROG Azoth&#40;&#43;&#36;245&#41;</option>
						</select>
						<p class="errMsg"> <?= array_data_fetch($_SESSION['errors'], "keyboard_selection", "") ?> </p>

						<label for="pc_numbers">Give us your desire for quantity:</label>
						<input type="number" name="pc_numbers" id="pc_numbers" value="<?= array_data_fetch($_SESSION['values'], 'pc_numbers', "") ?>">
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'pc_numbers', "") ?></p>
						<!-- The quantity should be returned to inputed value, or error code -->
					</fieldset>
				</div>

				<div class="part">
					<!-- Do not return credit card information -->
					<fieldset>
						<legend>Visa</legend>
						<label for="cardType">Card type</label>
						<select name="cardType" id="cardType">
							<option value="">---Please select your credit card---</option>
							<option value="visa">Visa</option>
							<option value="mastercard">Mastercard</option>
							<option value="americanExpress">American Express</option>
						</select>
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'cardType', "") ?></p>
						<label for="cardName">Name on Credit Card</label>
						<input type="text" name="cardName" id="cardName">
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'cardName', "") ?></p>
						<label for="cardNumber">Credit Card number</label>
						<input type="text" name="cardNumber" id="cardNumber">
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'cardNum', "") ?></p>
						<label for="expmonth">Credit Card Expiry month</label>
						<input type="number" name="expmonth" id="expmonth">
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'expmonth', "") ?></p>
						<label for="expyear">Credit Card Expiry year</label>
						<input type="number" name="expyear" id="expyear">
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'expyear', "") ?></p>
						<label for="cardCVV">Card Verification Value(CVV)</label>
						<input type="number" name="cardCVV" id="cardCVV">
						<p class="errMsg"><?= array_data_fetch($_SESSION['errors'], 'cvv', "") ?></p>
						<input type="submit" value="Check Out">
					</fieldset>
				</div>
			</div>
		</form>
	</main>

	<?php include 'includes/footer.inc' ?>

	<a href="#" class="top"></a>

</body>

</html>