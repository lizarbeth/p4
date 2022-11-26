<?php
    session_start();
    //need to GET username from session variable

    //connect to database
    $db = new mysqli("localhost", "INFX371", "P*ssword", "friend");
    if($db->connect_errno) {
        echo "Failed to connect to MySQL: " . $db->connect_errno;
    }

    //insert comments (data from 'POST') into database
    if(isset($_POST['text'])){
        $text = mysqli_real_escape_string($db, $_POST['text']);
        $date = date("Y:m:d");
        $time = date("h:i:s");
        //$user = $_SESSION['username'];
        $newPost = $db->query("INSERT INTO posts(postText, user, date, time) 
                                VALUES('$text', 'lizarbeth', '$date', '$time')"); //need to change with sessions
    }

    //pull info from database to display for user box on the side
    $userDetails = $db->query("SELECT username, firstName, lastName, pic FROM users WHERE username='lizarbeth'"); //change with sessions
    $users = $userDetails->fetch_assoc();

    //post stuff
    $postDetails = $db->query("SELECT p.postText, p.user, p.date, p.time, p.likeCount, p.postID, p.commentCount  
                                FROM posts p JOIN users u on u.username=p.user
                                WHERE p.user IN (SELECT user1 FROM friends WHERE user2='lizarbeth')
                                OR p.user IN (SELECT user2 FROM friends WHERE user1='lizarbeth')
                                OR (p.user='lizarbeth')"); //need to change with sessions
    
    $count = $db->query("SELECT COUNT(postID) FROM posts WHERE user='lizarbeth'");
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
        <link href="dashboard.css" rel="stylesheet" type="text/css">
        <title>Watering Hole</title>
    </head>
    <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <div class="container">
            <div class="row align-items-start">
                <div class="col-sm-1 pt-5 mt-5"> 
                    <!--profile picture -->
                    <img src=<?php echo $users['pic'];?> alt=profile pic></img>
                </div>

                <div class="col-sm-4 pt-5 mt-5">
                    <!-- bio info -->
                    <p> name: <?=$users['firstName'];?> </p>
                    <p> number of posts: <?php echo $countPosts; ?></p>
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
                <div class="col-sm-6 offset-sm-4">
                    <?php //display user information 
                        foreach($postDetails as $row){ ?>
                            <p> username: <?=$row["user"];?> </p>
                            <p> post text: <?=$row['postText'];?> </p>
                            <?php
                                $likes = $row['likeCount'];
                                $postID = $row['postID'];
                                $liker = 'lizarbeth'; //need to change with sessions
                                $commentID = $postID . "c";
                                $buttonID = $postID . "b";
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
                                    if($hours == 1){ $message = "Posted " . $hours . " hour ago today";
                                    } else { $message = "Posted " . $hours . " hours ago today";}  
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
                            <form id="<?php echo $postID;?>" action="test.php" method="GET">
                                <input type="hidden" name="like" class="like" value="<?php echo $row['postID'];?>"> 
                                <button type="submit" name="likeButton" value="<?php echo $row['postID'];?>">LIKE</button>
                                <label for="button">likes: <?=$row['likeCount']?></label>
                            </form> 

                            <!-- add comments through form-->
                            <form id="<?php echo $commentID;?>" class="commentBtn" action="test.php" method="GET">
                                <label for="text">Add a Comment</label><br>
                                <textarea name="text" id="text" rows="1" cols="50"></textarea>
                                <button type="submit">Post Comment</button>
                            </form>  
                            <p> ------------------------- </p>
                    
                            <!-- button to display comments (javascript) -->
                            <button type="submit" id="<?php echo $buttonID?>" class="showComments" onclick="showForm();">Show <?php echo $row['commentCount']?> Comments</button>
                    
                            <!-- print out comments -->
                            <div class="display" style="display:block;"> 
                                <?php 
                                    $commentDetails = $db->query("SELECT * FROM comments WHERE postID = '$postID'");
                                    foreach($commentDetails as $row2){
                                        $commenter = $row2['commenter'];
                                        $commentText = $row2['commentText']; ?>
                                        <p><?=$commenter?> says: </p>
                                        <p><?=$commentText?></p>

                            <?php   }?>
                            </div>  
                            
                            <p> *-----*-----*-----*-----* </p>
                <?php   }
                    if(isset($_GET['like'])){ 
                        $button = $_GET['like'];
                        $likes++;
                        $db->query("UPDATE posts SET likeCount = '$likes' WHERE postID='$button'");
                        $db->query("INSERT INTO likes (postID, liker) VALUES('$button','$liker')");
                    } ?> 
                    
                </div> 
            </div>
        </div> 
    </body>
</html>
