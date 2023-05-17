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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="style/animation.css">
	    <link rel="icon" href="images/tabicon.png">
        <link rel="stylesheet" href="style/form.css">
        <title>Dashboard</title>

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
                        <li class="active"><a href="dashboard.php">Dashboard</a></li>
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
            <div class="dashboard_container">
                <div class="dashboard_content">
                    <h1>Dashboard</h1>
                    <div class="menuoption">
                        <a href="editprofile.php">

                            <div class="dashcard ">
                                <div class="card1st">
                                    <img src="images/editprofile.jpg" alt="edit_photo">
        
                                </div>
                                <div class="pra pra-content">
                                    <span>Edit your profile</span>
        
                                </div>
                            </div>
                        </a>
                        <a href="service.php">

                            <div class="dashcard ">
                                <div class="card1st">
                                    <img src="images/input.jpeg" alt="edit_photo">
                                </div>
                                <div class="pra pra-content">
                                    <span>Input departments and hosts</span>
                                </div>
                            </div>
                        </a>
                        
                        <a href="cytoscape.php">

                            <div class="dashcard ">
                                <div class="card1st">
                                    <img src="images/gotoconfig.png" alt="edit_photo">
                                </div>
                                <div class="pra pra-content">
                                    <span>Go to your config</span>
                                </div>
                            </div>
                        </a>
                        <a href="deviceinfo.php">

                            <div class="dashcard ">
                                <div class="card1st">
                                    <img src="https://www.auvik.com/wp-content/uploads/2021/02/network-devices-router-switch-1-1400x600.jpg" alt="edit_photo">
                                </div>
                                <div class="pra pra-content">
                                    <span>Device Information</span>
                                </div>
                            </div>
                        </a>
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

