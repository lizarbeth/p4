<?php
//Accessing the database
$servername = "localhost";
$username = "INFX371";
$password = "P*ssword";
$dbname = "friend";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="dashboard.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cinzel|Fauna+One">
    <script src="https://kit.fontawesome.com/c924802615.js" crossorigin="anonymous"></script>
    <script src="animations.js"></script>
    <title>Watering Hole Profile</title>
</head>


<body>

    <!-- Creates navigation bar at the top of the page -->
    <nav class="navbar navbar-expand-sm navbar-dark" id="top">
        <!-- Extends container to the width of the viewport -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <div>
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft">
                        <i class="fa-solid fa-user fa-1x fa-border"></i>
                    </button>

                    <!-- Creates the offcanvas -->
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft">

                        <div class="offcanvas-header">
                            <div>
                                <i class="navbar-brand fa-solid fa-user fa-xl" id="profilepic"></i>
                                <h4>Username</h4>
                            </div>

                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"><i class="fa-solid fa-xmark fa-xl" id="xmark"></i></button>
                        </div>


                        <div class="offcanvas-body">
                            <ol class="fa-ul p-5">
                                <li id="home" class="container my-1 p-2"><a href="home.php"><span class="fa-li"><i class="fa-solid fa-house-flood-water" id="homein"></i></span>Home</a></li>
                                <li id="profile" class="container my-1 p-2"><a href="profile.php"><span class="fa-li"><i class="fa-solid fa-book-open-reader" id="profilein"></i></span>Profile</a></li>
                                <li id="drop" class="container my-1 p-2"><a href="#"><span class="fa-li"><i class="fa-solid fa-droplet" id="dropin"></i></span>Drops</a></li>
                                <li id="gear" class="container my-1 p-2"><a href="#"><span class="fa-li"><i class="fa-solid fa-gear" id="gearin"></i></span>Settings</a></li>
                            </ol>

                        </div>
                    </div>
                </div>

            </li>

            <li class="nav-item">
                <button class="btn p-2" data-bs-toggle="tooltip" title="Home">
                    <a class="nav-link" href="dashboard.php"><i class="fa-solid fa-house-flood-water fa-lg"></i></a>
                </button>

            </li>

            <li class="nav-item">
                <button class="btn p-2" data-bs-toggle="tooltip" title="Trending">
                    <a class="nav-link" href="#"><i class="fa-solid fa-arrow-trend-up fa-lg"></i></a>
                </button>
            </li>

            <li class="nav-item">
                <button class="btn p-2" data-bs-toggle="tooltip" title="News">
                    <a class="nav-link" href="#"><i class="fa-regular fa-newspaper fa-lg"></i></a>
                </button>
            </li>

            <li class="nav-item">
                <button class="btn p-2" data-bs-toggle="tooltip" title="Sign Out">
                    <a class="nav-link" href="#"><i class="fa-solid fa-right-from-bracket fa-lg"></i></a>
                </button>
            </li>

        </ul>

    </nav>

    <div class="mx-auto" id="z">
        <a href="dashboard.php"><img src="largelogo.png" alt="Logo"></a>
    </div>


    <div class="p-5 text-white text-center" id="heading">
        <h1><strong>Profile</strong></h1>
    </div>


    <div class="container-fluid card m-2 p-2">

        <ul class="nav nav-tabs nav-justified" role="tablist">

            <li class="nav-item">
                <a data-bs-toggle="tab" href="#bio" class="nav-link active" id="tab">Bio</a>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="tab" href="#comments" class="nav-link" id="tab">Posts</a>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="tab" href="#bottles" class="nav-link" id="tab">Bottles</a>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="tab" href="#drops" class="nav-link" id="tab">Drops</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane container active" id="bio"><br>
                <div>
                    <i class="fa-solid fa-user fa-xl" id="profilepic"></i>
                    <h4>Username</h4>
                    <div class="fs-6 blockquote-footer my-2">First Last</div>

                    <div class="row">
                        <span class="col fs-6 my-4"><i class="fa-solid fa-calendar"></i> Joined November 2022</span>
                        <span class="col fs-6 my-4"><i class="fa-solid fa-user-group"></i> 50 Friends</span>
                    </div>

                    <div class="row">
                        <span class="col fs-6 my-4"><i class="fa-solid fa-bottle-water"></i> 50 Bottles</span>
                        <span class="col fs-6 my-4"><i class="fa-solid fa-message"></i> 50 Posts</span>
                    </div>

                </div>
            </div>

            <div class="tab-pane container" id="comments"><br>
                <!-- The user's comments go here -->
            </div>

            <div class="tab-pane container fade" id="bottles"><br>
                <div class="container p-5">
                    <div class="card my-2">

                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-user fa-xl" id="profilepic"></i> User347592<span class="fs-6 blockquote-footer my-1">Posted x ago</span></h5>
                            <p>Welcome to the Watering Hole!</p>
                        </div>
                        <div class="card-footer border-top-0">
                            <div class="row">
                                <div class="col"><i class="fa-solid fa-reply fa-inverse"></i> 60k</div>
                                <div class="col"><i class="fa-solid fa-bottle-water"></i> 60k</div>
                                <div class="col"><i class="fa-solid fa-droplet fa-inverse"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="tab-pane container fade" id="drops"><br>
                <div class="container p-5">
                    <div class="card my-2">

                        <div class="card-body">

                            <h5 class="card-title"><i class="fa-solid fa-user fa-xl" id="profilepic"></i> User347592<span class="fs-6 blockquote-footer my-1">Posted x ago</span></h5>

                            <p>Welcome to the Watering Hole!</p>
                        </div>
                        <div class="card-footer border-top-0">
                            <div class="row">
                                <div class="col"><i class="fa-solid fa-reply fa-inverse"></i> 60k</div>
                                <div class="col"><i class="fa-solid fa-bottle-water"></i> 60k</div>
                                <div class="col"><i class="fa-solid fa-droplet fa-inverse"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="card my-2">

                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-user fa-xl" id="profilepic"></i> User347592<span class="fs-6 blockquote-footer my-1">Posted x ago</span></h5>
                            <p>Welcome to the Watering Hole!</p>
                        </div>
                        <div class="card-footer border-top-0">
                            <div class="row">
                                <div class="col"><i class="fa-solid fa-reply"></i> 60k</div>
                                <div class="col"><i class="fa-solid fa-bottle-water"></i> 60k</div>
                                <div class="col"><i class="fa-solid fa-droplet fa-inverse"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>



</html>
