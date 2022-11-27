<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header('location:login.php');
    }

    $username = $_SESSION["username"];

    $db = new mysqli("localhost", "INFX371", "P*ssword", "friend");
    if($db->connect_errno) {
        echo "Failed to connect to MySQL: " . $db->connect_errno;
    }


    //$username = 'lizarbeth'; //change with sessions

    //insert comments (data from 'POST') into database
    if(isset($_POST['text'])){
        $text = mysqli_real_escape_string($db, $_POST['text']);
        $date = date("Y:m:d");
        $time = date("h:i:s");
        //$user = $_SESSION['username'];
        $newPost = $db->query("INSERT INTO posts(postText, user, date, time) 
                                VALUES('$text', '$username', '$date', '$time')"); //need to change with sessions
    }

    //pull info from database to display for user box on the side
    $userDetails = $db->query("SELECT username, firstName, lastName, pic FROM users WHERE username='$username'"); //change with sessions
    $users = $userDetails->fetch_assoc();

    //post stuff
    $postDetails = $db->query("SELECT p.postText, p.user, p.date, p.time, p.likeCount, p.postID, p.commentCount, u.pic  
                                FROM posts p JOIN users u on u.username=p.user
                                WHERE p.user IN (SELECT user1 FROM friends WHERE user2='$username')
                                OR p.user IN (SELECT user2 FROM friends WHERE user1='$username')
                                OR (p.user='$username')
                                "); //need to change with sessions
    
    $count = $db->query("SELECT COUNT(postID) FROM posts WHERE user='$username'");
    $countPosts = $count->fetch_column();
  
    /*while($posts = $postDetails->fetch_assoc()){
        $postText = $posts['postText'];
        $postUser = $posts['user'];
        $postDate = $posts['date'];
        $postTime = $posts['time'];
    }*/

    $commentDetails = $db->query("SELECT * FROM comments");

?>

<!DOCTYPE html>
<html lang="en">
<head> <!-- not sure if any of these links for bootstrap are right -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cinzel|Fauna+One">
    <script src="animations.js"></script>
    <script src="https://kit.fontawesome.com/c924802615.js" crossorigin="anonymous"></script>
    <link href="dashboard.css" rel="stylesheet" type="text/css">
    <title>Watering Hole</title>
</head>
<body>
<!-- Creates navigation bar at the top of the page -->
<nav class="navbar navbar-expand-sm" id="top">
    <!-- Extends container to the width of the viewport -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <div>
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft">
                <img src=<?php echo $users['pic'];?> alt=profilepic class="navProfilePic"></img>
                </button>

                <!-- Creates the offcanvas -->
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft">
                    <div class="offcanvas-header">
                        <div>
                        <img src=<?php echo $users['pic'];?> alt=profilepic class="sideProfilePic"></img>
                            <h4><?php echo $username ?></h4>
                        </div>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"><i class="fa-solid fa-xmark fa-xl" id="xmark"></i></button>
                    </div>

                    <div class="offcanvas-body">
                        <ol class="fa-ul p-5">
                            <li id="home" class="container my-1 p-2"><a class="linkdecorationrm" href="dashboard.php"><span class="fa-li"><i class="fa-solid fa-house-flood-water" id="homein"></i></span>Home</a></li>
                            <li id="profile" class="container my-1 p-2"><a class="linkdecorationrm" href="profile.php?username=<?php echo $username?>"><span class="fa-li"><i class="fa-solid fa-book-open-reader" id="profilein"></i></span>Profile</a></li>
                            <li id="drop" class="container my-1 p-2"><a class="linkdecorationrm" href="profile.php?username=<?php echo $username?>"><span class="fa-li"><i class="fa-solid fa-droplet" id="dropin"></i></span>Drops</a></li>
                            <li id="gear" class="container my-1 p-2"><a class="linkdecorationrm" href="construction.php"><span class="fa-li"><i class="fa-solid fa-gear" id="gearin"></i></span>Settings</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <button class="btn p-2" data-bs-toggle="tooltip" title="Home">
                <a class="nav-link" href="dashboard.php"><i class="fa-solid fa-house-flood-water fa-lg" id="titleicons"></i></a>
            </button>
        </li>
        <li class="nav-item">
            <button class="btn p-2" data-bs-toggle="tooltip" title="Trending">
                <a class="nav-link" href="construction.php"><i class="fa-solid fa-arrow-trend-up fa-lg" id="titleicons"></i></a>
            </button>
        </li>
        <li class="nav-item">
            <button class="btn p-2" data-bs-toggle="tooltip" title="News">
                <a class="nav-link" href="construction.php"><i class="fa-regular fa-newspaper fa-lg" id="titleicons"></i></a>
            </button>
        </li>
        <li class="nav-item">
            <button class="btn p-2" data-bs-toggle="tooltip" title="Sign Out">
                <a class="nav-link" href="logout.php"><i class="fa-solid fa-right-from-bracket fa-lg" id="titleicons"></i></a>
            </button>
        </li>
    </ul>
</nav>
    <div class="mx-auto" id="z">
        <a href="dashboard.php"><img src="largelogo.png" alt="Logo"></a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <div class="container">
            <div class="row align-items-start">
                <div class="col-sm-1 pt-5 mt-5"> 
                    <!--profile picture -->
                    <a  href="profile.php?username=<?php echo $users['username'];?>" target="_blank">
                    <img class="bigProfilePic" src=<?php echo $users['pic'];?> alt="profile pic"></img>
                    </a>
                </div>

                <div class="col-sm-4 pt-5 mt-5">
                    <!-- bio info -->
                    <p> <?php echo $users['firstName'] . ' ' . $users['lastName'];?>  </p>
                    <p> <?php if($countPosts == 1){ echo $countPosts . " Post"; } else echo $countPosts . " Posts"; ?></p>
                </div>
                
                <!-- add a post -->
                <div class="col-6 pt-5 mt-5">
                    <form method="POST" action="dashboard.php">
                        <label for="text">Add a post</label><br>
                        <textarea name="text" id="text" rows="3" cols="50"></textarea>
                        <button type="submit">Post</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class=" col-sm-6 offset-sm-4">
                    <?php //display user information 
                        foreach($postDetails as $row){ ?>
                            <img src=<?php echo $row['pic'];?> alt=profilepic class="profilepic"></img>
                            <p><a href="profile.php?username=<?=$row["user"];?>" target="_blank"><?=$row["user"];?></a> </p>
                            <p><?=$row['postText'];?> </p>
                            <?php
                                $likes = $row['likeCount'];
                                $commentCount = $row['commentCount'];
                                $postID = $row['postID'];
                                //$liker = '$username'; //need to change with sessions
                                $profilePic = $row['pic'];
                                $postedDate = $row['date'];
                                $commentID = $postID . "c";
        
                                //get days and weeks
                                $date = strtotime(date('Y-m-d'));
                                $postDate = strtotime($postedDate);
                                $seconds = $date - $postDate;
                                $days = $seconds / 86400;

                                //get hours
                                $localtime = strtotime(date('h:i:s'));
                                $postTime = strtotime($row['time']);
                                $seconds2 = $localtime - $postTime;
                                $hours = round($seconds2 / 3600);
                                
                                if ($days <= 1 && $hours < 24){
                                    if($hours == 1){ $message = "Posted " . $hours . " hour ago";
                                    } else { $message = "Posted less than an hour ago";}  
                                } 
                                else if ($days < 7 && $days > 1){
                                    if($days = 1){ $message = "Posted " . $days . " day ago on " . $postedDate;
                                    } else { $message = "Posted " . $days . " days ago on " . $postedDate;}
                                } 
                                else if ($days <= 31 && $days >=7){
                                    $weeks = round($days / 7);
                                    if($weeks = 1){ $message = "Posted " . $weeks . " week ago on " . $postedDate;
                                    } else { $message = "Posted ". $weeks . " weeks ago on " . $postedDate; }
                                } ?> 
                            <p><?php echo $message;?> </p>
                    
                            
                            <!-- like button and like count -->
                            <form id="<?php echo $postID;?>" action="dashboard.php" method="POST">
                                <input type="hidden" name="like" class="like" value="<?php echo $row['postID'];?>"> 
                                <button type="submit" name="likeButton" value="<?php echo $row['postID'];?>">LIKE</button>
                                <label for="button">likes: <?=$row['likeCount']?></label>
                            </form> 

                            <!-- add comments through form-->
                            <form id="<?php echo $commentID;?>" class="commentBtn" action="dashboard.php" method="POST">
                                <label for="comment">Add a Comment</label><br>
                                <textarea name="comment" id="comment" rows="1" cols="50"></textarea>
                                <input type="hidden" name="commentPostID" value="<?php echo $row['postID'];?>">
                                <button type="submit">Post Comment</button>
                            </form>  
                            
                    
                            <!-- button to display comments (javascript) -->
                            
                            <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse<?=$postID?>" aria-expanded="false">Show <?php echo $commentCount;?> Comments</button>
                            <!-- print out comments -->
                            <div class="multi-collapse<?=$postID?> collapse" style="display:block;">
                                <div class="multi-collapse<?=$postID?> collapse"> 
                                    <?php 
                                    $commentDetails = $db->query("SELECT p.postID, c.commenter, c.commentText, c.time, c.date, p.user, p.commentCount, u.pic
                                    FROM comments c JOIN posts p ON c.postID=p.postID JOIN users u ON u.username=c.commenter WHERE p.postID = '$postID'");
                                    foreach($commentDetails as $row2){
                                        $postedDate = $row['date'];
        
                                        //get days and weeks
                                        $date = strtotime(date('Y-m-d'));
                                        $postDate = strtotime($postedDate);
                                        $seconds = $date - $postDate;
                                        $days = $seconds / 86400;

                                        //get hours
                                        $localtime = strtotime(date('h:i:s'));
                                        $postTime = strtotime($row['time']);
                                        $seconds2 = $localtime - $postTime;
                                        $hours = round($seconds2 / 3600);
                                        
                                        if ($days <= 1 && $hours < 24){
                                            if($hours == 1){ $message = "Posted " . $hours . " hour ago";
                                            } else { $message = "Posted less than an hour ago";}  
                                        } 
                                        else if ($days < 7 && $days > 1){
                                            if($days = 1){ $message = "Posted " . $days . " day ago on " . $postedDate;
                                            } else { $message = "Posted " . $days . " days ago on " . $postedDate;}
                                        } 
                                        else if ($days <= 31 && $days >=7){
                                            $weeks = round($days / 7);
                                            if($weeks = 1){ $message = "Posted " . $weeks . " week ago on " . $postedDate;
                                            } else { $message = "Posted ". $weeks . " weeks ago on " . $postedDate; }
                                        } ?> <?php
                                        $commenter = $row2['commenter'];
                                        $commentText = $row2['commentText']; ?>
                                        <img src=<?php echo $row2['pic'];?> alt=profilepic class="profilepic"></img>
                                        <p><a href="profile.php?username=<?php echo $commenter?>" target="_blank"><?php echo $commenter?></a> says: </p>
                                        <p><?=$commentText?></p>
                                        <p><?php echo $message;?> </p>

                            <?php   } 
                            ?>
                                </div> 
                            </div>
                        
                            
                <?php   }
                    if(isset($_POST['like'])){ 
                        $button = $_POST['like'];
                        $likes++;
                        $db->query("UPDATE posts SET likeCount = '$likes' WHERE postID='$button'");
                        $db->query("INSERT INTO likes (postID, liker) VALUES('$button','$username')");
                        
                    } 
                    if(isset($_POST['comment']) && isset($_POST['commentPostID'])){
                        $postID = $_POST['commentPostID'];
                        $commentText = mysqli_real_escape_string($db,$_POST['comment']);
                        $commentCount++;
                        $date = date("Y:m:d");
                        $time = date("h:i:s");
                        $db->query("UPDATE posts SET commentCount = '$commentCount' WHERE postID='$postID'");
                        $db->query("INSERT INTO comments (postID, commenter, commentText, time, date)
                                    VALUES('$postID', '$username', '$commentText', '$date', '$time')");
                    }
                    ?> 
                    
                </div> 
            </div>
        </div> 

    <footer class="container-fluid mt-5 py-3 text-center" id="footerprofile">
        <h5><strong>Water Fanatics Inc.</strong></h5>
        <h5><strong><a class="linkdecorationrm" href="wiki/home.php">Like water? Learn more on our Wiki!</a></strong></h5>
    </footer>
                                
    </body>
</html>
