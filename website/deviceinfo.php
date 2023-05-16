<?php
//if logged in, go to manager page
session_start();
if ((isset($_SESSION['authenticated']) && $_SESSION['authenticated']) || (isset($_SESSION['admin']) && $_SESSION['admin'])) {
    
}else{
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
							echo "<li><a href='admin.php'>Admin</a></li>";
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
            <div class="devicepage">
                <h1>Device Information</h1>
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
            </div>
		</main>
	</div>

	<footer>
		<p>Dang Nam Khanh, Le Xuan Nhat, Duong Quang Thanh</p>
		<p>Copyright &copy; 2023 TNE:GO. All rights Reserved</p>
	</footer>

</body>

</html>