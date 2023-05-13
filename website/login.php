<?php
    require_once("./functions/functions.php");

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
          header('Location: admin.php');
        }else if (($password == $row->password) && ($username == $row->username)){
          echo $row->username;
          header('Location: dashboard.php');
        }

      ?>
    </tr>
<?php endforeach; ?>


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
                    <!-- <label for="button" id="nav_icon"><img src="images/nav.png" alt="navbar"></label> -->
                    <label for="button" id="nav_icon"><i class="fa-solid fa-bars"></i></label>
                    <ul>
                        <li ><a href="homepage.html">Homepage</a></li>
                        <li><a href="service.html">Service</a></li>
                        <li><a href="admin.html">Admin</a></li>
                        <li ><a href="ourteam.html">Our Team</a></li>
                        <li class="active"><a href="login.html">Login</a></li>
                    </ul>

                </div>
            </nav>

        </header>
        
        <main>
            <div class="login_space">
                <form action="login.php" method="POST" class="animate__animated animate__fadeInRight">
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
                                <a href="registration.html">Sign up</a>
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

