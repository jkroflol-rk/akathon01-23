<?php
//if logged in, go to manager page
session_start();
if ((isset($_SESSION['authenticated']) && $_SESSION['authenticated']) || (isset($_SESSION['admin']) && $_SESSION['admin'])) {
    header('Location: ./index.php');
} else {
    // header('Location: ./login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="images/tabicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.css">
    <link rel="stylesheet" href="style/form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
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
                        <li><a href="index.php">Homepage</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="ourteam.php">Our Team</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>

                </div>
            </nav>

        </header>

        <main>
            <div class="login_space">
                <form action="newacc.php" method="POST" class="animate__animated animate__fadeInRight">
                    <div class="loginform registrationform">
                        <?php
                            if (isset($_GET['noti'])) {
                                $noti = urldecode($_GET['noti']);
                                echo "<p class='error1'>" . $noti . "</p>";
                            }
                            
                        ?>
                        <h1>Registration</h1>
                        <div class="registration_container">

                            <div class="left_registration">
                                <div class="input_field">
                                    <input type="text" name="fname" id="fname" required autocomplete="off">
                                    <span></span>
                                    <label for="fname">Firstname:</label>
                                </div>

                                <div class="input_field">
                                    <input type="text" name="email" id="email" required autocomplete="off">
                                    <span></span>
                                    <label for="email">Email:</label>
                                </div>

                                <div class="input_field">
                                    <input type="text" name="username" id="username" required autocomplete="off">
                                    <span></span>
                                    <label for="username">Username:</label>
                                </div>
                            </div>

                            <div class="right_registration">
                                <div class="input_field">
                                    <input type="text" name="lname" id="lname" required autocomplete="off">
                                    <span></span>
                                    <label for="lname">Lastname:</label>
                                </div>

                                <div class="input_field">
                                    <input type="tel" name="phone" id="phone" required autocomplete="off">
                                    <span></span>
                                    <label for="phone">Phone number:</label>
                                </div>

                                <div class="input_field">
                                    <input type="password" name="password" id="password" required autocomplete="off">
                                    <span></span>
                                    <label for="password">Password:</label>
                                </div>

                            </div>
                        </div>

                        <input type="submit" value="Sign up">
                        <div class="signup_link">Already an user?
                            <a href="login.php">Sign in</a>
                        </div>
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