<?php

session_start();
if (!isset($_SESSION["username"])) {
    header('location:login.php');
}
//Accessing the database
$servername = "localhost";
$dbusername = "INFX371";
$password = "P*ssword";
$dbname = "friend";

// Create connection
$db = new mysqli($servername, $dbusername, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

//add username to the URL - not necessarily who is logged in 
$username = $_GET['username']; 
$loggedInUser = $_SESSION["username"]; //change with sessions to be the session variable

//get logged in user picture
$loggedInUserQuery = $db->query("SELECT pic FROM users WHERE username='$loggedInUser'");
$loggedInUserPic = $loggedInUserQuery->fetch_column();

//get user bio info
$userInfo = $db->query("SELECT * FROM users WHERE username='$username'");
$user = $userInfo->fetch_assoc();

//get the count of posts
$count = $db->query("SELECT COUNT(postID) FROM posts WHERE user='$username'");
$countPosts = $count->fetch_column();

//get the count of friends
$friends = $db->query("SELECT COUNT(user1) FROM friends 
                        WHERE (user1='$username' OR user2='$username');");
$friendCount = $friends->fetch_column();

//get all post information
$postDetails = $db->query("SELECT p.user,p.postText,p.date,p.time,p.likeCount,p.commentCount,u.pic, p.postID
                            FROM posts p JOIN users u ON p.user=u.username
                            WHERE user='$username'");
$posts = $postDetails->fetch_assoc();

//get the amount of likes based on user
$likesGiven = $db->query("SELECT COUNT(likeID) FROM likes WHERE liker='$username'");
$likesGivenOut = $likesGiven->fetch_column();

//posts the user has liked:
$likedPosts = $db->query("SELECT p.postText,p.user,p.likeCount,p.commentCount,l.liker,u.firstName,u.lastName,u.pic, p.time, p.date, p.postID
                            FROM posts p JOIN likes l ON p.postID=l.postID
                            JOIN users u ON p.user=u.username WHERE liker = '$username'");
$displayLikedPosts = $likedPosts->fetch_assoc();

//check if user logged in is friend's with the profile to add comments or not
$friendCheckQuery = $db->query("SELECT COUNT(*) FROM friends WHERE (user1='$loggedInUser' OR user2='$loggedInUser')
                                AND (user1='$username' OR user2='$username')");
$friendCheck = $friendCheckQuery->fetch_column();

//comment data for user's posts
$commentData = $db->query("SELECT p.postID, c.commenter, c.commentText, c.time, c.date, p.user, p.commentCount
                            FROM comments c JOIN posts p ON c.postID=p.postID WHERE p.user='$username'");
$comments = $commentData->fetch_assoc();


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
    <nav class="navbar navbar-expand-sm" id="top">
        <!-- Extends container to the width of the viewport -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <div>
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft">
                        <!--<i class="fa-solid fa-user fa-1x fa-border"></i>-->
                        <img src=<?php echo $loggedInUserPic;?> alt=profilepic class="navProfilePic"></img>
                    </button>

                    <!-- Creates the offcanvas -->
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft">

                        <div class="offcanvas-header">
                            <div>
                                <!--<i class="navbar-brand fa-solid fa-user fa-xl" id="profilepic"></i>-->
                                <img src=<?php echo $loggedInUserPic;?> alt=profilepic class="sideProfilePic"></img>
                                <h4><?php echo $loggedInUser?></h4>
                            </div>

                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"><i class="fa-solid fa-xmark fa-xl" id="xmark"></i></button>
                        </div>


                        <div class="offcanvas-body">
                            <ol class="fa-ul p-5">
                                <li id="home" class="container my-1 p-2"><a class="linkdecorationrm" href="dashboard.php"><span class="fa-li"><i class="fa-solid fa-house-flood-water" id="homein"></i></span>Home</a></li>
                                <li id="profile" class="container my-1 p-2"><a class="linkdecorationrm" href="profile.php?username=<?php echo $loggedInUser?>"><span class="fa-li"><i class="fa-solid fa-book-open-reader" id="profilein"></i></span>Profile</a></li>
                                <li id="drop" class="container my-1 p-2"><a class="linkdecorationrm" href="profile.php?username=<?php echo $loggedInUser?>"><span class="fa-li"><i class="fa-solid fa-droplet" id="dropin"></i></span>Drops</a></li>
                                <li id="gear" class="container my-1 p-2"><a class="linkdecorationrm" href="construction.php"><span class="fa-li"><i class="fa-solid fa-gear" id="gearin"></i></span>Settings</a></li>
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
                    <a class="nav-link" href="logout.php"><i class="fa-solid fa-right-from-bracket fa-lg" id="titleicons"></i></a>
                </button>
            </li>

        </ul>

    </nav>

    <div class="mx-auto" id="z">
        <a href="dashboard.php"><img src="largelogo.png" alt="Logo"></a>
    </div>



    <div class="m-5 card p-2 d-flex justify-content-center">

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
                    <!--<i class="fa-solid fa-user fa-xl" id="profilepic"></i>-->
                    <img src=<?php echo $user['pic'];?> alt=profilepic class="profilepic"></img>
                    <h4><?php echo $user['username'];?></h4>
                    <div class="fs-6 blockquote-footer my-2"><?php echo $user['firstName']; echo ' '; echo $user['lastName'];?></div>

                    <div class="row">
                        <span class="col fs-6 my-4"><i class="fa-solid fa-calendar"></i> Joined <?php echo $user['joined'];?></span>
                        <span class="col fs-6 my-4"><i class="fa-solid fa-user-group"></i> <?php echo $friendCount;?> Friends</span>
                    </div>

                    <div class="row">
                        <span class="col fs-6 my-4"><i class="fa-solid fa-bottle-water"></i> <?php echo $likesGivenOut;?> Likes</span>
                        <span class="col fs-6 my-4"><i class="fa-solid fa-message"></i> <?php echo $countPosts;?> Posts</span>
                    </div>
                </div>
            </div>

            <div class="tab-pane container" id="comments"><br>
                <!-- The user's comments go here -->
                <div class="container-fluid p-5 ">
                    
                <div class="card my-2 d-flex justify-content-center">
                        
                    <?php foreach($postDetails as $row){
                            $postedDate = $row['date'];
                            $commentCount = $row['commentCount'];
                            $postID = $row['postID'];
                        
                            //get days and weeks
                            $date = strtotime(date('Y-m-d'));
                            $postDate = strtotime($postedDate);
                            $seconds = $date - $postDate;
                            $days = $seconds / 86400;

                            //get hours
                            $localtime = strtotime(date('h:i:s'));
                            $postTime = strtotime($row['time']);
                            $seconds2 = $localtime - $postTime;
                            $hours = round(abs($seconds2 / 3600)); 
                            
                            if ($days <= 1 && $hours < 24){
                                if($hours <= 1){ $message = "Posted less than an hour ago";
                                } else { $message = "Posted " . $hours . " hours ago";}                              
                               
                            } 
                            else if ($days < 7 && $days > 1){
                                if($days == 1){ $message = "Posted " . $days . " day ago on " . $postedDate;
                                } else { $message = "Posted " . $days . " days ago on " . $postedDate;}
                            } 
                            else if ($days <= 31 && $days >=7){
                                $weeks = round($days / 7);
                                if($weeks == 1){ $message = "Posted " . $weeks . " week ago on " . $postedDate;
                                } else { $message = "Posted ". $weeks . " weeks ago on " . $postedDate; }
                            } 
                            if($commentCount == 1){
                                $commentCountMessage = "Show " . $commentCount . " Comment";
                            } else { $commentCountMessage = "Show " . $commentCount . " Comments";
                            }
                            ?> 
                            
                        <div class="card-body">
                            <h5 class="card-title"><img src=<?php echo $row['pic'];?> class="profilepic" alt=profile pic></img><?=$row['user'];?> <span class="fs-6 blockquote-footer my-1"> <?php echo $message;?></span></h5>
                            <p><?php echo $row['postText']; ?></p>
                        </div>
                        
                        <div class="card-footer border-top-0">
                            <div class="row">
                                <div class="col"><span id="replyiconlisten"><i class="fa-solid fa-reply colorone" id="replyiconin"></i></span><?php echo ' '. $row['commentCount'];?></div>
                                <div class="col"><span id="bottleiconlisten"><i class="fa-solid fa-bottle-water colortwo" id="bottleiconin"></i></span><?php echo' '. $row['likeCount'];?></div>
                                <div class="col"><span id="dropleticonlisten"><i class="fa-solid fa-droplet colorone" id="dropleticonin"></i></span></div>
                            </div>
                        </div>
                        <?php if($commentCount > 0){ ?>
                        <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse<?=$postID?>" aria-expanded="false">Show Comments</button>
                        
                            <!-- print out comments -->
                            <div class="multi-collapse<?=$postID?> collapse" style="display:block;">
                                <div class="multi-collapse<?=$postID?> collapse"> 
                        <?php 
                            $commentDetails = $db->query("SELECT p.postID, c.commenter, c.commentText, c.time, c.date, p.user, p.commentCount, u.pic
                            FROM comments c JOIN posts p ON c.postID=p.postID JOIN users u ON u.username=c.commenter WHERE p.postID = '$postID'");
                            foreach($commentDetails as $row2){
                                    $postedDate = $row2['date'];
    
                                    //get days and weeks
                                    $date = strtotime(date('Y-m-d'));
                                    $postDate = strtotime($postedDate);
                                    $seconds = $date - $postDate;
                                    $days = $seconds / 86400;
                                    

                                    //get hours
                                    $localtime = strtotime(date('h:i:s'));
                                    $postTime = strtotime($row2['time']);
                                    $seconds2 = $localtime - $postTime;
                                    $hours = round(abs($seconds2 / 3600));
                                    
                                    
                                    
                                    if ($days <= 1 && $hours < 24){
                                        if($hours <= 1){ $message = "Posted less than an hour ago";
                                        } else { $message = "Posted " . $hours . " hours ago";}  
                                    } 
                                    else if ($days < 7 && $days > 1){
                                        if($days == 1){ $message = "Posted " . $days . " day ago on " . $postedDate;
                                        } else { $message = "Posted " . $days . " days ago on " . $postedDate;}
                                    } 
                                    else if ($days <= 31 && $days >=7){
                                        $weeks = round($days / 7);
                                        if($weeks == 1){ $message = "Posted " . $weeks . " week ago on " . $postedDate;
                                        } else { $message = "Posted ". $weeks . " weeks ago on " . $postedDate; }
                                    } ?> <?php
                                    $commenter = $row2['commenter'];
                                    $commentText = $row2['commentText']; ?>
                                    <div class="card d-flex justify-content-center ms-5 mt-2 mb-3">
                                        <div class="card-body">
                                            <h6 class="card-title">
                                                <img src="<?php echo $row2['pic'];?>" alt="profilepic" class="profilepic">
                                                <a href="profile.php?username=<?php echo $commenter?>" target="_blank"><?php echo $commenter?></a> <span class="fs-6 blockquote-footer my-1"><?php echo $message;?></span>
                                            </h6>
                                            <p><?=$commentText?></p>
                                        </div>
                                    </div>
                                    <?php   } ?>
                                <?php   } ?>
                        
                        
                                </div> 
                            </div> 
                    <?php } ?>
                </div>
                </div>
            </div>

            <div class="tab-pane container fade" id="bottles"><br>
                <div class="container-fluid p-5 ">

                    <!-- Template for liked comments-->
                    
                    <div class="card my-2 d-flex justify-content-center">
                        <?php foreach($likedPosts as $row){
                            $postedDate = $row['date'];
                            $postID = $row['postID'];
                            $commentCount = $row['commentCount'];
                            
                        
                            //get days and weeks
                            $date = strtotime(date('Y-m-d'));
                            $postDate = strtotime($postedDate);
                            $seconds = $date - $postDate;
                            $days = $seconds / 86400;

                            //get hours
                            $localtime = strtotime(date('h:i:s'));
                            $postTime = strtotime($row['time']);
                            $seconds2 = $localtime - $postTime;
                            $hours = round(abs($seconds2 / 3600)); 
                            
                            if ($days <= 1 && $hours < 24){
                                if($hours <= 1){ $message = "Posted less than an hour ago";
                                } else { $message = "Posted " . $hours . " hours ago";}                               
                               
                            } 
                            else if ($days < 7 && $days > 1){
                                if($days == 1){ $message = "Posted " . $days . " day ago on " . $postedDate;
                                } else { $message = "Posted " . $days . " days ago on " . $postedDate;}
                            } 
                            else if ($days <= 31 && $days >=7){
                                $weeks = round($days / 7);
                                if($weeks == 1){ $message = "Posted " . $weeks . " week ago on " . $postedDate;
                                } else { $message = "Posted ". $weeks . " weeks ago on " . $postedDate; }
                            } 
                            
                            if($commentCount == 1){
                                $commentCountMessage = "Show " . $commentCount . " Comment";
                            } else { $commentCountMessage = "Show " . $commentCount . " Comments";}

                            ?> 
                            
                        <div class="card-body">
                            <h5 class="card-title"><img src=<?php echo $row['pic'];?> class="profilepic" alt=profile pic></img><?=$row['user'];?><span class="fs-6 blockquote-footer my-1"> <?php echo $message;?></span></h5>
                            <p><?php echo $row['postText']; ?></p>
                        </div>
                        
                        
                        
                        <div class="card-footer border-top-0">
                            <div class="row">
                                <div class="col"><span id="replyiconlisten"><i class="fa-solid fa-reply colorone" id="replyiconin"></i></span> <?php echo ' '. $commentCount;?></div>
                                <div class="col"><span id="bottleiconlisten"><i class="fa-solid fa-bottle-water colortwo" id="bottleiconin"></i></span><?php echo ' ' . $row['likeCount'];?></div>
                                <div class="col"><span id="dropleticonlisten"><i class="fa-solid fa-droplet colorone" id="dropleticonin"></i></span></div>
                            </div>
                        </div> 
                        <?php if($commentCount > 0){ ?>
                        <!-- display the comments on the liked posts -->
                        <button class="btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse<?=$postID?>" aria-expanded="false">Show Comments</button>
                            <!-- print out comments -->
                            <div class="multi-collapse<?=$postID?> collapse" style="display:block;">
                                <div class="multi-collapse<?=$postID?> collapse"> 
                                    <?php
                                    $commentDetails = $db->query("SELECT p.postID, c.commenter, c.commentText, c.time, c.date, p.user, p.commentCount, u.pic
                                    FROM comments c JOIN posts p ON c.postID=p.postID JOIN users u ON u.username=c.commenter WHERE p.postID = '$postID' ORDER BY c.date DESC");
                                    foreach($commentDetails as $row2){
                                        $postedDate = $row2['date'];
        
                                        //get days and weeks
                                        $date = strtotime(date('Y-m-d'));
                                        $postDate = strtotime($postedDate);
                                        $seconds = $date - $postDate;
                                        $days = $seconds / 86400;
                                        

                                        //get hours
                                        $localtime = strtotime(date('h:i:s'));
                                        $postTime = strtotime($row2['time']);
                                        $seconds2 = $localtime - $postTime;
                                        $hours = round(abs($seconds2 / 3600));
                                        
                                        
                                        
                                        if ($days <= 1 && $hours < 24){
                                            if($hours <= 1){ $message = "Posted less than an hour ago";
                                            } else { $message = "Posted " . $hours . " hours ago";}  
                                        } 
                                        else if ($days < 7 && $days > 1){
                                            if($days == 1){ $message = "Posted " . $days . " day ago on " . $postedDate;
                                            } else { $message = "Posted " . $days . " days ago on " . $postedDate;}
                                        } 
                                        else if ($days <= 31 && $days >=7){
                                            $weeks = round($days / 7);
                                            if($weeks == 1){ $message = "Posted " . $weeks . " week ago on " . $postedDate;
                                            } else { $message = "Posted ". $weeks . " weeks ago on " . $postedDate; }
                                        } ?> <?php
                                        $commenter = $row2['commenter'];
                                        $commentText = $row2['commentText']; ?>
                                        <div class="card d-flex justify-content-center ms-5 mt-2 mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                    <img src="<?php echo $row2['pic'];?>" alt="profilepic" class="profilepic">
                                                    <a href="profile.php?username=<?php echo $commenter?>" target="_blank"><?php echo $commenter?></a> <span class="fs-6 blockquote-footer my-1"><?php echo $message;?></span>
                                                </h6>
                                                <p><?=$commentText?></p>
                                            </div>
                                        </div>

                            <?php   } ?>
                        <?php } ?>
                                </div> 
                            </div> 
                    <?php } ?>              
                    </div>
                </div>
            </div>

            <div class="tab-pane container fade" id="drops"><br>
                <div class="container p-5">
                    <div class="d-flex justify-content-center fadedmessage">
                        <h2><i class="fa-regular fa-face-sad-tear fa-5x d-flex justify-content-center m-2"></i>You're Out of Drops!</h2>
                    </div>
                </div>
            </div>
        
        </div>
    </div>


    <footer class="container-fluid mt-5 py-3 text-center" id="footerprofile">
        <h5><strong>Water Fanatics Inc.</strong></h5>
        <h5><strong><a class="linkdecorationrm" href="wiki/home.php">Like water? Learn more on our Wiki!</a></strong></h5>
    </footer>
                 
                              
</body>

</html>
