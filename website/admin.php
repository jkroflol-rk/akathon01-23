<?php
//if logged in, go to manager page
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin']) {

} else {
	header('Location: ./login.php');
}

include('./conn/func.php');

$data = getData("users");

$d_data = getData("devices");

if (isset($_GET['order_id'])) {
	$del_id = $_GET['order_id'];
	$delete = deleteData("users", $del_id);
	echo $delete;
	header('Location: ./admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="style/animation.css">
	<link rel="stylesheet" href="style/form.css">
	<link rel="icon" href="images/tabicon.png">
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
					<?php foreach ($data->data as $row): ?>
						<div class="order-card hello">
							<h2 class="customer-name">Name:
								<?= $row->lastname ?> 	<?= $row->firstname ?>
							</h2>
							<p class="ordered-time">Ordered Time:
								<?= $row->order_time ?>
							</p>
							<p class="num-vlans">Number of Vlans
								<?= $row->vlan ?>
							</p>
							<p class="num-vlans">Username:
								<?= $row->username ?>
							</p>
							<p class="num-vlans">Password:
								<?= $row->password ?>
							</p>
							<ul class="host-list">
								<?php
								$array = $row->vlans;
								foreach ($array as $dep) {
									echo "<li>" . $dep->key . ": " . $dep->value . "</li>";
								}
								?>
							</ul>
							<a href="admin.php?order_id=<?= $row->id ?>" class="test_btn">Click to Delete</a>

						</div>

					<?php endforeach; ?>

				</div>
			</div>

			<div class="device_info">
				<?php foreach ($d_data->data as $d_row): ?>

					<div class="item-box product-box">

						<img src="<?= $d_row->image ?>" alt="Item image 1">
						<h2>
							<?= $d_row->name ?>
						</h2>

						<div class="extra-content">
							<table>
								<tr>
									<th>Size</th>
									<td>
										<?= $d_row->size ?>
									</td>
								</tr>
								<tr>
									<th>Weight</th>
									<td>
										<?= $d_row->weight ?>
									</td>
								</tr>
								<tr>
									<th>Price</th>
									<td>
										<?= $d_row->price ?>
									</td>
								</tr>
								<tr>
									<th>Port</th>
									<td>
										<?= $d_row->port ?>
									</td>
								</tr>
								<tr>
									<th>Bandwidth</th>
									<td>
										<?= $d_row->bandwidth ?>
									</td>
								</tr>

							</table>
							<br>
							<a href="<?= $d_row->link ?>" target="_blank">More info</a>
						</div>

					</div>
				<?php endforeach; ?>

			</div>

			<div class="add_device">
				<h2>developers rating</h2>

					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Port</th>
								<th>Bandwidth</th>
								<th>Price</th>
								<th>Size</th>
								<th>Weight</th>
								<th>Control</th>
								<!-- <th>Weight</th> -->
							</tr>
						</thead>

						<tbody>
							<?php foreach ($d_data->data as $d_row): ?>
								<tr>

									<td><?= $d_row->id ?></td>
									<td><?= $d_row->name ?></td>
									<td><?= $d_row->port ?></td>
									<td><?= $d_row->bandwidth ?></td>
									<td><?= $d_row->price ?></td>
									<td><?= $d_row->size ?></td>
									<td><?= $d_row->weight ?></td>
									<td>
										<a class="button_two" href="updatedevices.php?device_id=<?= $d_row->id ?>" 
										onclick="return confirm('Are you sure you want to delete this device?\nDevice name: <?= $d_row->name ?>\nID: <?= $d_row->id ?>')">Delete</a>
									</td>
								</tr>
							<?php endforeach; ?>
							<form action="updatedevices.php" method="POST">
								<tr>
									<td>
										<p>Add a device &#40;Dont leave any blank field&#41;</p>
									</td>
									<td><input type="text" name="name" required></td>
									<td><input type="text" name="port" required></td>
									<td><input type="text" name="bandwidth" required></td>
									<td><input type="text" name="price" required></td>
									<td><input type="text" name="size" required></td>
									<td><input type="text" name="weight" required></td>
									
									<td>
										<input type="submit" value="Submit" class="button_one">
									</td>
								</tr>
							</form>



						</tbody>
					</table>
			</div>


		</main>
	</div>

	<footer>
		<p>Dang Nam Khanh, Le Xuan Nhat, Duong Quang Thanh</p>
		<p>Copyright &copy; 2023 TNE:GO. All rights Reserved</p>
	</footer>

</body>

</html>