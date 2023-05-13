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
                        <li><a href="Dashboard.php">Dashboard</a></li>
                        <li ><a href="ourteam.php">Our Team</a></li>
                        <li ><a href="login.php">Login</a></li>
                    </ul>

                </div>
            </nav>
            
        </header>
        
        <main>
            <div class="login_space">
                <form action="authentication.php" method="POST" class="animate__animated animate__fadeInRight">
                    <div class="loginform registrationform">
                        <h1>Edit Your Profile</h1>
                        <form method="post" action="authentication.php" id="registered_form">
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

                                    <div class="input_field">
                                        <input type="password" name="newpassword" id="newpassword" required autocomplete="off">
                                        <span></span>
                                        <label for="newpassword">New password:</label>
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
                                        <label for="password">Current password:</label>
                                    </div>
    
                                    <div class="input_field">
                                        <input type="password" name="repassword" id="repassword" required autocomplete="off">
                                        <span></span>
                                        <label for="repassword">Retype your new password:</label>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" value="Save changes">

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
    
    <script src="js/animation.js"></script>
    
</body>
</html>

