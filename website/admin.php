<?php

$url = "https://b81155ba-05ce-415b-9ca4-b83d935e46a6-asia-south1.apps.astra.datastax.com/api/rest/v2/keyspaces/test/users/rows";
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
$pass = "jane.doe@example.com";
echo $pass;

$data = json_decode($response);
$username = $_POST["username"];
$password = $_POST["password"];
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
							<li ><a href="index.php">Homepage</a></li>
							<li><a href="service.php">Service</a></li>
							<li ><a href="ourteam.php">Our Team</a></li>
							<li ><a href="login.php">Login</a></li>
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

				</div>

				<table id="userstable">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Departments</th>
			<th>Users</th>
			
		</tr>
		<br>
	</thead>
	<tbody>
		<?php foreach ($data->data as $row): ?>
			<tr>
				<td><?= $row->id ?></td>
				<td><?= $row->email ?></td>
				<td><?= $row->firstname ?></td>
				<td><?= $row->lastname ?></td>
				<td><?= $row->username ?></td>
				<td><?= $row->password ?></td>

				<?php
					if (($password == $row->password) && ($username == $row->username && ($row->admin == "true"))){
						header('Location: https://rt-kc.github.io/akathon01-23/website/index.html');
						
					}else if (($password == $row->password) && ($username == $row->username)){
						echo $row->username;
						header('Location: http://www.example.com/');
					}
					
				?>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
			</main>
	</div>
	
	<footer>
			<p>Dang Nam Khanh, Le Xuan Nhat, Duong Quang Thanh</p>
			<p>Copyright &copy; 2023 TNE:GO. All rights Reserved</p>
	</footer>
	
	<script src="js/animation.js"></script>
		
</body>
</html>

