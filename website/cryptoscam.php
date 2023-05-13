<?php
//if logged in, go to manager page
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.css">
    <link rel="stylesheet" href="style/form.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <script src="js/form.js"></script>
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
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li ><a href="ourteam.php">Our Team</a></li>
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
            
        </main>
    </div>
        
    <footer>
        <p>Dang Nam Khanh, Le Xuan Nhat, Duong Quang Thanh</p>
        <p>Copyright &copy; 2023 TNE:GO. All rights Reserved</p>
    </footer>
</body>
</html>