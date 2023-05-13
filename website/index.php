<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="style/form.css">

    <script src="js/form.js"></script>
    <title>Information</title>
</head>
<body>
    <div class="fixbug">
        <header>

            
            <nav >
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
            <div class="introduction_page">
                <!-- <img src="images/png-clipart-black-and-white-tp-link-wireless-router-illustration-wireless-router-wi-fi-computer-network-router-electronics-data-transfer-rate-removebg-preview.png" alt="Router" class="animate__animated animate__fadeInLeft"> -->
                <a href="#service_introduction"><i class="fa-solid fa-chevron-down" id="down_icon"></i></a>
                <div class="intro_text animate__animated animate__fadeInRight">
                    <h1 >TNE:GO, The best choice</h1>
                    <p>Connect your company effortlessly with our networking service.</p>
                    <br>
                    <a href="login.html" class="intro_btn btn1">Login</a> 
                    <a href="registration.html" class="intro_btn btn2">Sign Up</a> 
                </div>
                
            </div>

            <div class="service_introduction" id="service_introduction">
                <div class="service_content">

                    <video class="video" autoplay loop muted>
                        <source src="images/space-65881.mp4" type="video/mp4" fps=""/>
                    </video>
    
                    <div class="service_list">
                        <h1>A peek at the syntax...</h1>
                        <p>Get your business connected and thriving with our top-quality devices, efficient network structures, and reliable installation work. We specialize in providing tailored network solutions for businesses of all sizes. Contact us today to learn more!</p>
                        <p class="m-1">Here are some qualities that we bring you:</p>
                        <ol>
                            <li>Connect your offices</li>
                            <li>Reliable service</li>
                            <li>Security</li>
                            <li>Fast setup</li>
                            <li>Redundancy</li>
                        </ol>
                    </div>

                </div>

            </div>
            <div class="open_source">
                <div class="left_logo">
                    <h1>Open Source</h1>
                    <img src="images/ciscologo.png" alt="cisco logo">
                </div>

                <div class="right_logo">
                    <div>
                        <h3>Source code</h3>
                        <p> <a href="#">cytoscape.js</a></p>
                        <p><a href="#">cisco</a></p> 
                        <p><a href="#">Swiper.js</a></p> 
                    </div>

                    <div>
                        <h3>Some other links</h3>
                        <p><a href="#">datatax</a></p> 
                        <p><a href="#">recent techniques</a></p> 
                        <p><a href="#">images from:</a></p> 
                    </div>
                </div>
            </div>

            <div class="logo_source">
                <div class="logo_container">
                    <div class="logo_image">
                        <img src="images/datastaxlogo.jpg" alt="datastaxlogo">
                        <p>Main sponsor in this program</p>
                    </div>

                    <div class="logo_image">
                        <img src="images/Picture1.png" alt="swinburnelogo">
                        <p>Main sponsor in this program</p>
                    </div>

                    <div class="logo_image">
                        <img src="images/akathonlogo.jpg" alt="akathonlogo">
                        <p>Main sponsor in this program</p>
                    </div>

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

