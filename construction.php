<?php
session_start();
if (!isset($_SESSION["username"])) {
    header('location:login.php');
}
$username = $_SESSION["username"];

//connect to database
$db = new mysqli("localhost", "INFX371", "P*ssword", "friend");
if($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_errno;
}
$username='lizarbeth'; //change with sessions

$userDetails = $db->query("SELECT username, firstName, lastName, pic FROM users WHERE username='$username'"); //change with sessions
$user = $userDetails->fetch_assoc();

?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="dashboard.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cinzel|Fauna+One">
    <script src="https://kit.fontawesome.com/c924802615.js" crossorigin="anonymous"></script>
    <title>Watering Hole</title>
</head>

<body>
<nav class="navbar navbar-expand-sm" id="top">
        <!-- Extends container to the width of the viewport -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <div>
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft">
                        <!--<i class="fa-solid fa-user fa-1x fa-border"></i>-->
                        <img src=<?php echo $user['pic'];?> alt=profilepic class="navProfilePic"></img>
                    </button>

                    <!-- Creates the offcanvas -->
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft">

                        <div class="offcanvas-header">
                            <div>
                                <!--<i class="navbar-brand fa-solid fa-user fa-xl" id="profilepic"></i> -->
                                <img src=<?php echo $user['pic'];?> alt=profilepic class="sideProfilePic"></img>
                                <h4><?php echo $username?></h4>
                            </div>

                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"><i class="fa-solid fa-xmark fa-xl" id="xmark"></i></button>
                        </div>


                        <div class="offcanvas-body">
                            <ol class="fa-ul p-5">
                                <li id="home" class="container my-1 p-2"><a class="linkdecorationrm" href="dashboard.php"><span class="fa-li"><i class="fa-solid fa-house-flood-water" id="homein"></i></span>Home</a></li>
                                <li id="profile" class="container my-1 p-2"><a class="linkdecorationrm" href="profile.php?username=<?php echo $username ?>"><span class="fa-li"><i class="fa-solid fa-book-open-reader" id="profilein"></i></span>Profile</a></li>
                                <li id="drop" class="container my-1 p-2"><a class="linkdecorationrm" href="#"><span class="fa-li"><i class="fa-solid fa-droplet" id="dropin"></i></span>Drops</a></li>
                                <li id="gear" class="container my-1 p-2"><a class="linkdecorationrm" href="#"><span class="fa-li"><i class="fa-solid fa-gear" id="gearin"></i></span>Settings</a></li>
                            </ol>

                        </div>
                    </div> 
                </div>
            </li>

            <!-- navigation bar -->
            <li class="nav-item">
                <button class="btn p-2" data-bs-toggle="tooltip" title="Home">
                    <a class="nav-link" href="dashboard.php"><i class="fa-solid fa-house-flood-water fa-lg" id="titleicons"></i></a>
                </button>

            </li>

            <li class="nav-item">
                <button class="btn p-2" data-bs-toggle="tooltip" title="Trending">
                    <a class="nav-link" href="#"><i class="fa-solid fa-arrow-trend-up fa-lg" id="titleicons"></i></a>
                </button>
            </li>

            <li class="nav-item">
                <button class="btn p-2" data-bs-toggle="tooltip" title="News">
                    <a class="nav-link" href="#"><i class="fa-regular fa-newspaper fa-lg" id="titleicons"></i></a>
                </button>
            </li>

            <li class="nav-item">
                <button class="btn p-2" data-bs-toggle="tooltip" title="Sign Out">
                    <a class="nav-link" href="#"><i class="fa-solid fa-right-from-bracket fa-lg" id="titleicons"></i></a>
                </button>
            </li>

        </ul>

    </nav>
    <div class="mx-auto" id="z">
        <a href="dashboard.php"><img src="largelogo.png" alt="Logo"></a>
    </div>

    <div class="row d-flex pt-5 justify-content-center">
        <img class="center-block" src="noSwimming.png"> <br>
    </div>

    <div class="row d-flex pt-5 text-center"> 
        <h4> No Swimming! </h4>
        <h4>This page isn't quite ready.</h4>
    </div>

    <footer class="container-fluid mt-5 py-3 text-center" id="footerprofile">
        <h5><strong>Water Fanatics Inc.</strong></h5>
        <h5><strong><a class="linkdecorationrm" href="wiki/home.php">Like water? Learn more on our Wiki!</a></strong></h5>
    </footer>
    
    
</body>
</html>
