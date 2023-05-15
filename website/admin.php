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
			<div class="topology">
				<h1>Manage Order</h1>
				<div class="hello_container">
					<div class="order-card hello">
						<h2 class="customer-name">Customer Name</h2>
						<p class="ordered-time">Ordered Time: [Date and Time]</p>
						<p class="num-vlans">Number of VLANs: [Number]</p>
						<ul class="host-list">
							<li>[Hostname 1]</li>
							<li>[Hostname 2]</li>
							<li>[Hostname 3]</li>
							<!-- ... -->
							<li>[Hostname N]</li>
						</ul>
						<!-- <button class="test_btn" type="button">Click to Delete</button> <br> -->
						<button class="test_btn" type="button">Click to Delete</button>
					</div>
					<div class="order-card hello">
						<h2 class="customer-name">Customer Name</h2>
						<p class="ordered-time">Ordered Time: [Date and Time]</p>
						<p class="num-vlans">Number of VLANs: [Number]</p>
						<ul class="host-list">
							<li>[Hostname 1]</li>
							<li>[Hostname 2]</li>
							<li>[Hostname 3]</li>
							<!-- ... -->
							<li>[Hostname N]</li>
						</ul>
						<!-- <button class="test_btn" type="button">Click to Delete</button> <br> -->
						<button class="test_btn" type="button">Click to Delete</button>
					</div>
					<div class="order-card hello">
						<h2 class="customer-name">Customer Name</h2>
						<p class="ordered-time">Ordered Time: [Date and Time]</p>
						<p class="num-vlans">Number of VLANs: [Number]</p>
						<ul class="host-list">
							<li>[Hostname 1]</li>
							<li>[Hostname 2]</li>
							<li>[Hostname 3]</li>
							<!-- ... -->
							<li>[Hostname N]</li>
						</ul>
						<!-- <button class="test_btn" type="button">Click to Delete</button> <br> -->
						<button class="test_btn" type="button">Click to Delete</button>
					</div>
					<div class="order-card hello">
						<h2 class="customer-name">Customer Name</h2>
						<p class="ordered-time">Ordered Time: [Date and Time]</p>
						<p class="num-vlans">Number of VLANs: [Number]</p>
						<ul class="host-list">
							<li>[Hostname 1]</li>
							<li>[Hostname 2]</li>
							<li>[Hostname 3]</li>
							<!-- ... -->
							<li>[Hostname N]</li>
						</ul>
						<!-- <button class="test_btn" type="button">Click to Delete</button> <br> -->
						<button class="test_btn" type="button">Click to Delete</button>
					</div>
					<div class="order-card hello">
						<h2 class="customer-name">Customer Name</h2>
						<p class="ordered-time">Ordered Time: [Date and Time]</p>
						<p class="num-vlans">Number of VLANs: [Number]</p>
						<ul class="host-list">
							<li>[Hostname 1]</li>
							<li>[Hostname 2]</li>
							<li>[Hostname 3]</li>
							<!-- ... -->
							<li>[Hostname N]</li>
						</ul>
						<!-- <button class="test_btn" type="button">Click to Delete</button> <br> -->
						<button class="test_btn" type="button">Click to Delete</button>
					</div>

				</div>
			</div>
			<div class="collapse">
				<button type="button" class="collapsible">Open Collapsible</button>
				<div class="content">
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias at quas sunt eveniet voluptate, adipisci fugit dolorum libero sit eaque nobis nam, ex repellendus nostrum tenetur asperiores obcaecati perspiciatis deserunt.</p>
				</div>
				<button type="button" class="collapsible">Open Collapsible</button>
				<div class="content">
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias at quas sunt eveniet voluptate, adipisci fugit dolorum libero sit eaque nobis nam, ex repellendus nostrum tenetur asperiores obcaecati perspiciatis deserunt.</p>
				</div>

				<table id="userstable">
					<th>
						<tr>
							<th>id</th>
							<th>admin</th>
							<th>email</th>
							<th>firstname</th>
							<th>lastname</th>
							<th>order-time</th>
							<th>password</th>
							<th>phone</th>
							<th>username</th>
							<th>vlan</th>
							<th>vlans</th>
						</tr>
					</th>
					<tbody>
						<?php foreach ($data->data as $row) : ?>
							<tr>
								<td><?= $row->id ?></td>
								<td><?= $row->admin ?></td>
								<td><?= $row->email ?></td>
								<td><?= $row->firstname ?></td>
								<td><?= $row->lastname ?></td>
								<td><?= $row->order_time ?></td>
								<td><?= $row->password ?></td>
								<td><?= $row->phone ?></td>
								<td><?= $row->username ?></td>
								<td><?= $row->vlan ?></td>
								<td><?php echo json_encode($row->vlans); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				
				
			</div>

			<div class="device_info">

				<div class="item-box product-box">

					<img src="images/sw2960.jpg" alt="Item image 1">
					<h2>Cisco Catalyst 2960</h2>
					<h2>&#36;539</h2>

					<div class="extra-content">
						<table>
							<tr>
								<th>Size</th>
								<td>19inches, 4.45cm in height</td>
							</tr>
							<tr>
								<th>Weight</th>
								<td>2.27kg to 3.18kg</td>
							</tr>
							<tr>
								<th>Price</th>
								<td>Gigabyte B460M DS3H</td>
							</tr>
							<tr>
								<th>Port</th>
								<td>48 ports</td>
							</tr>
							<tr>
								<th>Bandwidth</th>
								<td>100 Mbps</td>
							</tr>
							<tr>
								<th>Link</th>
								<td>Support layer 2, used for connecting device</td>
							</tr>
							<tr>
								<th>SSD</th>
								<td>Kingston A400 240GB</td>
							</tr>
							<tr>
								<th>HDD</th>
								<td>WD Blue 1TB</td>
							</tr>
							<tr>
								<th>Fan</th>
								<td>Cooler Master SickleFlow 120</td>
							</tr>
						</table>
						<br>
						<a href="payment.php?product_id=1">More info</a>
					</div>

				</div>
				<div class="item-box product-box">

					<img src="images/sw3650.jpg" alt="Item image 1">
					<h2>Cisco Catalyst 2960</h2>
					<h2>&#36;539</h2>

					<div class="extra-content">
						<table>
							<tr>
								<th>Size</th>
								<td>19inches, 4.45cm in height</td>
							</tr>
							<tr>
								<th>Weight</th>
								<td>4.54kg to 9.07kg</td>
							</tr>
							<tr>
								<th>Price</th>
								<td>Gigabyte B460M DS3H</td>
							</tr>
							<tr>
								<th>Port</th>
								<td>48 ports</td>
							</tr>
							<tr>
								<th>Bandwidth</th>
								<td>100 Mbps</td>
							</tr>
							<tr>
								<th>Link</th>
								<td>Support layer 2, used for connecting device</td>
							</tr>
							<tr>
								<th>SSD</th>
								<td>Kingston A400 240GB</td>
							</tr>
							<tr>
								<th>HDD</th>
								<td>WD Blue 1TB</td>
							</tr>
							<tr>
								<th>Fan</th>
								<td>Cooler Master SickleFlow 120</td>
							</tr>
						</table>
						<br>
						<a href="payment.php?product_id=1">More info</a>
					</div>

				</div>
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