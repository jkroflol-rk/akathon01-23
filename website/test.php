<?php
//if logged in, go to manager page
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin']) {
	
} else {
	header('Location: ./login.php');
}
?>

<?php

$url = "https://b81155ba-05ce-415b-9ca4-b83d935e46a6-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/users/rows/";
$token = "AstraCS:PXhWiFwCPFWfmLXqOGtkOlCU:ef2043b13fcc33dd3e63368eabf3a4379cf561fda6dec8ae2490832acde2ab39";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	"Content-Type: application/json",
	"Accept: application/json",
	"X-Cassandra-Token: $token"
));
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.css">
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="style/animation.css">
	<link rel="icon" href="images/tabicon.png">
	<link rel="stylesheet" href="style/form.css">
	<!-- <link
	rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"> -->
	<!-- <script src="https://unpkg.com/cytoscape@3.24.0/dist/cytoscape.min.js"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dagre/0.8.5/dagre.min.js"></script> -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/cytoscape-dagre@2.5.0/cytoscape-dagre.min.js"></script> -->
	<!-- <script src="js/djtmeakathon.js"></script> -->
	<title>Information</title>

</head>

<body>
	<div class="fixbug">
		<header>
			<nav>
				<h1>TNE:GO</h1>
				<div class="nav_links">
					<input type="checkbox" id="button">
					<label for="button" id="nav_icon"><i class="fa-solid fa-bars"></i></label>
					<ul>
						<li><a href="index.php">Homepage</a></li>
						<li><a href="dashboard.php">Dashboard</a></li>
						<li><a href="ourteam.php">Our Team</a></li>
						<?php
							if (isset($_SESSION['admin']) && $_SESSION['admin']) {
								echo "<li class='active'><a href='admin.php'>Admin</a></li>";
							}
							if ((isset($_SESSION['authenticated']) && $_SESSION['authenticated']) || (isset($_SESSION['admin']) && $_SESSION['admin'])) {
								echo "<li><a href='logout.php'>Logout</a></li>";
							} else {
								echo "<li><a href='login.php'>Login</a></li>";
							}
						?>
					</ul>

				</div>
			</nav>

		</header>

		<main>
			

			<div class="device_info">

				<p>hello</p>
				<p>hello</p>
				<p>hello</p>
				<p>hello</p>
			</div>
		</main>
	</div>

	<footer>
		<p>Dang Nam Khanh, Le Xuan Nhat, Duong Quang Thanh</p>
		<p>Copyright &copy; 2023 TNE:GO. All rights Reserved</p>
	</footer>

	<script src="js/animation.js"></script>

</body>

</html>