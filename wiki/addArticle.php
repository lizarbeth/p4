<?php
session_start();
//Checks if session is active. If not, redirects to login page.
if (!isset($_SESSION["username"])) {
    header('location:index.php');
}



//$shortTitle = $_GET['short_title']; //this will append the right article to URL
//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db = new mysqli("localhost", "INFX371", "P*ssword", "wiki");   //connect to db
if($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_errno;
}
$dbResults = $db->query("SELECT shortTitle FROM articles");
$arrayResults = $dbResults->fetch_assoc();
$count = count($arrayResults);
//echo $count;
//print_r($arrayResults);

$articlequery = "SELECT * FROM articles ORDER BY shortTitle ASC";
$articleresult = $db->query($articlequery);
$articleinfo = $articleresult -> fetch_all(MYSQLI_ASSOC);
$numarticles = mysqli_num_rows($articleresult);

$username = $_SESSION["username"];

if(isset($_POST['title']) && isset($_POST['shortTitle']) && isset($_POST['article'])){
    $shortTitle = $_POST['shortTitle'];
    $title = $_POST['title'];
    $article = mysqli_real_escape_string($db, $_POST['article']);

    for($i=0; $i<=$count-1; $i++){
        //print_r ($arrayResults[$i]);
        if($shortTitle == $arrayResults['shortTitle']){
            echo "Please choose a different short title";
            break;
        } elseif ($i == $count-1 && $shortTitle != $arrayResults[$count-1]) {
            $db->query("INSERT INTO articles(shortTitle, author, title, text) VALUES ('$shortTitle', '$username','$title', '$article')");
            header("Location: home.php");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Water Source</title>
    <meta charset="utf-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="waterwiki.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cinzel|Fauna+One">
    <script src="button.js" type="text/javascript"></script>
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


    <!-- Creates the banner beneath the navigation bar -->
    <div class="p-5 text-white text-center" id="heading">
        <h1><strong>Add an Article!</strong></h1>
    </div>

    <!-- Creates the body containing a large card in the center of the page -->
    <div class="container d-flex justify-content-center">

        <div class="card p-5 my-5" id="article">

            <!-- Creates heading at the top of the card -->
            <div>
                <h2>Add Your Article Below</h2>
                <h3 class="blockquote-footer my-3">Is your head swimming with thoughts about water? Write them down until the well runs dry!<br>
                    You can write anything you want as long as it is respectful, accurate, and water-related!</h3><br>
            </div>

            <!-- Creates the form for the user to fill out -->
            <div>
                <form id="addArticle" method="POST" action="addArticle.php">

                    <div class="form-floating mb-3 mt-3">
                        <input type=text id="title" name="title" class="form-control"> <br>
                        <label for="title">Add a title: </label><br>
                    </div>

                    <div class="form-floating mb-3 mt-3">
                        <input type=text id="shortTitle" name="shortTitle" class="form-control"> <br>
                        <label for="shortTitle">Create a unique short title to quickly reference your article: </label><br>
                        <!-- need to find a way to loop through the created articles and
                        not allow user to enter the same article short title -->
                    </div>

                    <div class="form-floating mb-3 mt-3">
                        <textarea name="article" id="articletext" rows="4" cols="50" class="form-control"></textarea><br>
                        <label for="articletext">Add article text: </label><br>
                    </div>


                    <button type="submit">Create article</button>
                </form>

            </div>

        </div>

    </div>


</body>

</html>
