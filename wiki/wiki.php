<?php
session_start();
if (!isset($_SESSION["username"])) {
    header('location:index.php');
}


$shortTitle = $_GET['short_title']; //this will append the right article to URL

$db = new mysqli("localhost", "INFX371", "P*ssword", "wiki");   //connect to db
if($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_errno;
}

$articlequery = "SELECT * FROM articles ORDER BY shortTitle ASC";
$articleresult = $db->query($articlequery);
$articleinfo = $articleresult -> fetch_all(MYSQLI_ASSOC);
$numarticles = mysqli_num_rows($articleresult);

//select everything from article table
$title = $db->query("SELECT * FROM articles WHERE shortTitle = '$shortTitle'");

$articleInfo = $title->fetch_assoc();
$articleTitle = $articleInfo['title'];
$articleAuthor = $articleInfo['author'];
$articleText = $articleInfo['text'];

//SELECT data from textarea and put into $variable
$text = $db->query("SELECT text FROM articles WHERE shortTitle = '$shortTitle'");
$newText = $text->fetch_assoc();

//append new data (retrieved from $_POST) to $variable
//$appendedText;
//$appenedText .= $newText;
//UPDATE the column 'text' where short_title="$shortTitle" with new, appended data: $variable
if(isset($_POST['text'])){
    $userInput = $_POST['text'];
    $newText['text'] .= $userInput;
    $escapeText = mysqli_real_escape_string($db, $newText['text']);
    $db->query("UPDATE articles SET text='$escapeText' WHERE shortTitle ='$shortTitle'");
    header("Location: wiki.php?short_title=$shortTitle");
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

    <nav class="navbar navbar-expand-sm navbar-dark" id="top">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addArticle.php">Add Article</a>
                </li>
                <li class="nav-item">
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Current Articles</button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">

                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel">Articles</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>

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
            </ul>
        </div>
    </nav>

    <div class="p-5 text-white text-center" id="heading">
        <h1><strong><?php echo $articleTitle?></strong></h1>
    </div>

    <div class="container">
        <div class="card p-5 my-5" id="article">

            <div>
                <h2><strong><?php echo $articleTitle?></strong></h2>
                <h4 class="blockquote-footer my-3"><?php echo $articleAuthor ?></h4>
            </div>


            <div class="lead text-start text-break">
                <p><?php echo nl2br($newText['text']) ?></p>
            </div>

            <div class="add">
                <button type="submit" id="addButton" onclick="showForm()" class="submitbtn">Edit article</button>

                <form id="addText" method="POST" action="wiki.php?short_title=<?=$shortTitle?>" style="display:none;"> <!-- inline style -->
                    <!-- form needs to redirect to wiki.php?short_title=$shortTitle -->
                    <label for="text">Add to the article:</label><br>
                    <textarea name="text" id="text" rows="4" cols="50"></textarea><br>
                    <button type="submit">Add changes</button>
                    <!-- submit button needs to "refresh/redirect" to show changes -->

                </form>
            </div>
        </div>
    </div>
</body>
</html>
