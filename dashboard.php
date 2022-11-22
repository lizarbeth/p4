<?php
    session_start();
    //connect to database
    $db = new mysqli("localhost", "INFX371", "P*ssword", "friend");
    if($db->connect_errno) {
        echo "Failed to connect to MySQL: " . $db->connect_errno;
    }

    //insert data from 'post' into database
    if(isset($_POST['text'])){
        $text = mysqli_real_escape_string($db, $_POST['text']);
        $date = date("Y:m:d");
        $time = date("h:i:s");
        //$user = $_SESSION['username'];
        $newPost = $db->query("INSERT INTO posts(postText, user, date, time) 
                                VALUES('$text', 'lizarbeth', '$date', '$time')");
    }

    //pull info from database to display
        //for user box on the side
    $userDetails = $db->query("SELECT username, firstName, lastName, pic FROM users"); //WHERE username == $user
    $users = $userDetails->fetch_assoc();

    $postDetails = $db->query("SELECT p.postText, p.user, p.date, p.time, p.likeCount  
                                FROM posts p JOIN users u on u.username=p.user
                                WHERE p.user IN (SELECT user1 FROM friends WHERE user2='lizarbeth')
                                OR p.user IN (SELECT user2 FROM friends WHERE user1='lizarbeth')
                                OR (p.user='lizarbeth')");
    
    //like button function
    if(isset($_POST['count'])){
        // grab post id and count for that post
        // count += 1
        // UPDATE likeCOUNT to new count
    }
    

    while($posts = $postDetails->fetch_assoc()){
        $postText = $posts['postText'];
        $postUser = $posts['user'];
        $postDate = $posts['date'];
        $postTime = $posts['time'];
    }

    $count = $db->query("SELECT COUNT(postID) FROM posts WHERE user='lizarbeth'");
    $countPosts = $count->fetch_column();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="dashboard.css" rel="stylesheet" type="text/css">
        <title>The Watering Hole</title>
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
                    <p> name: <?=$users['firstName'];?> </p>
                    <p> number of posts: <?php echo $countPosts; ?></p>
                </div>
            

            <div class="col-6 pt-5 mt-5">
                <form method="POST" action="dashboard.php">
                    <label for="text">Add your comment</label><br>
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
                        <p> date posted: <?=$row['date'];?> </p>
                        <p> time posted: <?=$row['time'];?> </p>
                        <form class="likeButton" action="dashboard.php" method="POST">
                            <input type="hidden" name="count">
                            <button type="submit">LIKE</button>
                            <label for="button">likes: <?=$row['likeCount']?></label>
                        </form>
                        <p> ------------------------- </p>
                    <?php 
                        if(isset($_POST['count'])){
                            $likes = $row['likeCount'];

                        }
                    } ?>

                    <?php  
                    //display post information ?>
            </div> 
            </div>
        </div> 
    </body>
</html>
