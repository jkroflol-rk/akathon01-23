<?php
//if logged in, go to manager page
session_start();
if ((isset($_SESSION['authenticated']) && $_SESSION['authenticated']) || (isset($_SESSION['admin']) && $_SESSION['admin'])) {
} else {
    header('Location: ./login.php');
}
include('./conn/func.php');

$data = getData("users");
$read = json_decode("users");
echo $read;

$temp_id = $_SESSION['userid'];
$vlan = null;
foreach ($data->data as $row) {
    if ($row -> id === $temp_id) {
        $vlan = $row -> vlans; // Assign the VLAN value
        $read = json_encode($vlan);
        break; // Exit the loop since the ID is found
    }
}
$jsonData = printVlan($read);
echo $jsonData;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.css">
    <link rel="stylesheet" href="style/form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://unpkg.com/cytoscape@3.24.0/dist/cytoscape.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dagre/0.8.5/dagre.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cytoscape-dagre@2.5.0/cytoscape-dagre.min.js"></script>
    <link rel="stylesheet" href="style/test.css">
    <script src="js/form.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
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
            <script>
                var jsonData = <?php echo $jsonData; ?>; // Assign the JSON data to a JavaScript variable
            </script>
            <div id="cy"></div>
            <script src="./js/final.js"></script>
        </main>
    </div>

    <footer>
        <p>Dang Nam Khanh, Le Xuan Nhat, Duong Quang Thanh</p>
        <p>Copyright &copy; 2023 TNE:GO. All rights Reserved</p>
    </footer>
</body>

</html>