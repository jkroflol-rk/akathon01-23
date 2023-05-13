<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link rel="stylesheet" href="style/form.css">
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
                    <!-- <label for="button" id="nav_icon"><img src="images/nav.png" alt="navbar"></label> -->
                    <label for="button" id="nav_icon"><i class="fa-solid fa-bars"></i></label>
                    <ul>
                        <li ><a href="index.php">Homepage</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li ><a href="ourteam.php">Our Team</a></li>
                        <li class="active"><a href="login.php">Login</a></li>
                    </ul>

                </div>
            </nav>

        </header>
        
        <main>
            <div class="login_space">
                <form action="authentication.php" method="POST" class="animate__animated animate__fadeInRight" autocomplete="off">
                    <div class="loginform">
                        <h1>Login</h1>
                        <form method="post" action="authentication.php">
                            <div class="input_field">
                                <input type="text" name="username" id="username" required autocomplete="off">
                                <span></span>
                                <label for="username">Username:</label>
                            </div>

                            <div class="input_field">
                                <input type="password" name="password" id="password" required autocomplete="off">
                                <span></span>
                                <label for="password">Password:</label>
                            </div>
                            <input type="submit" value="Login">
                            <div class="signup_link">Not registered? 
                                <a href="registration.php">Sign up</a>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
        </main>
    </div>
        
    <footer>
        <p>Dang Nam Khanh, Le Xuan Nhat, Duong Quang Thanh</p>
        <p>Copyright &copy; 2023 TNE:GO. All rights Reserved</p>
    </footer>
</body>
</html>

