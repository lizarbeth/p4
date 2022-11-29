<?php
session_start();
//Checks if session is active. If not, redirects to login page.
if (!isset($_SESSION["username"])) {
    header('location:index.php');
}

//Accessing the database
$servername = "localhost";
$username = "INFX371";
$password = "P*ssword";
$dbname = "wiki";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
//Queries database for articles
$articlequery = "SELECT * FROM articles ORDER BY shortTitle ASC";
$articleresult = $mysqli->query($articlequery);
$articleinfo = $articleresult -> fetch_all(MYSQLI_ASSOC);

//Finds number of articles in database
$numarticles = mysqli_num_rows($articleresult);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="waterwiki.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cinzel|Fauna+One">
    <title>Water Wiki</title>
</head>

<body>
    <!-- Creates navigation bar at the top of the page -->
    <nav class="navbar navbar-expand-sm navbar-dark" id="top">
        <!-- Extends container to the width of the viewport -->
        <div class="container-fluid">
            <ul class="navbar-nav">
                <!-- Creates an a link to the home page in the navigation bar -->
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <!-- Creates a link to the add article page -->
                <li class="nav-item">
                    <a class="nav-link" href="addArticle.php">Add Article</a>
                </li>
                <!-- Creates an item in the navigation bar that will open up a sidebar(offcanvas) on the right of the viewport that contains a list of current articles-->
                <li class="nav-item">
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">Current Articles</button>

                    <!-- Creates the offcanvas -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight">

                        <div class="offcanvas-header">
                            <h5>Articles</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                        </div>

                        <!-- Offcanvas body runs through articles and outputs each of them as a card with an image and a link to the article -->
                        <div class="offcanvas-body">
                            <?php
                            for ($i=0; $i<$numarticles; $i++) {
                                ?>
                                <div class="row d-flex justify-content-center" id="canvaslist">
                                    <div class="card my-5" id="column">
                                        <img src="Default.jpg" alt="<?=$articleinfo[$i]["shortTitle"]?>" class="img-fluid" id="canvasphotos" data-bs-toggle="offcanvas" data-bs-target="offcanvasRight">
                                        <div class="card-text">
                                            <a href="wiki.php?short_title=<?=$articleinfo[$i]["shortTitle"]?>" class="overlaytext"><?=$articleinfo[$i]["shortTitle"]?></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                </li>
                <!-- Creates a sign out link in the navigation bar -->
                <li class="nav-item">
                    <a class="nav-link" href="signout.php"><strong>Sign Out</strong></a>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Creates the Banner just beneath the navigation bar -->
    <div class="p-5 text-white text-center" id="heading">
        <h1><strong>Water Wiki</strong></h1>
        <p><strong>Welcome to the Wikipedia Page for all Types of Water!</strong></p>
    </div>

    <!-- Contains the body of the page that houses all the articles as cards -->
    <div class="container">
        <?php
        // Finds number of rows for the grid based on 3 articles per row
        $numrows=$numarticles/3;
        $w=0;
        for ($i=0; $i<$numrows; $i++) {
            ?>

            <div class="row">
                <?php
                //Fills out the grid with cards and moves to the next row once the current row reaches 3 cards
                for($c=$w; $c<$numarticles; $c++) {
                    if ($c%3==0 and $c!=$w) {
                        $w=$c;
                        break;
                    }
                    else {
                        ?>
                        <!-- Creates cards containing an image and the link to the article it represents -->
                        <div class="col d-flex justify-content-center">
                            <div class="card my-5" id="column">
                                <img src="Default.jpg" alt="<?=$articleinfo[$c]["shortTitle"]?>" class="img-fluid" id="photos">
                                <div class="middle">
                                    <a href="wiki.php?short_title=<?=$articleinfo[$c]["shortTitle"]?>" class="text"><?=$articleinfo[$c]["shortTitle"]?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
        }

        ?>
    </div>

    <!-- The footer at the bottom of the page -->
    <div class="container-fluid mt-5 p-2 text-white text-center" id="footer">
        <p>Water Fanatics Inc.</p>
    </div>

</body>
</html>
