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
     
    //$postDetails = $db->query("SELECT postText, u.firstName, u.lastName, date, time, u.username
                                //FROM users u JOIN posts p ON u.username=p.user");

    $postDetails = $db->query("SELECT friendship, user1, user2, p.postText, p.user, p.date, p.time  
                            FROM friends f JOIN users uo ON f.user1=uo.username 
                            JOIN users ut ON f.user2=ut.username 
                            JOIN posts p ON f.user2=p.user 
                            WHERE friendship=1");

    /*$friendStatus = $db->query("SELECT * FROM friends WHERE (user1='lizarbeth' OR user2='lizarbeth')
                                    AND friendship=1");
    while($friendInfo = $friendStatus->fetch_assoc()){
        $user1 = $friendInfo['user1'];
        $user2 = $friendInfo['user2'];
        $friendship = $friendInfo['friendship'];
        //echo $user1;
        //echo $user2;
    }
        $friendPosts = $db->query("SELECT * FROM posts WHERE (user='$user1' OR user='$user2')");
        while($friendPostsResults = $friendPosts->fetch_assoc()){
            $text = $friendPostsResults['postText'];
            $user = $friendPostsResults['user'];
            $date = $friendPostsResults['date'];
            $time = $friendPostsResults['time'];
            if($user=='lizarbeth'){

            }
    
    echo $text;
            echo "<br>";
            echo $user;
            echo "<br>";
            echo $date;
            echo "<br>";
            echo $time;
            echo "<br>";
    }*/
    

    while($posts = $postDetails->fetch_assoc()){
        $postText = $posts['postText'];
        $postUser = $posts['user'];
        $postDate = $posts['date'];
        $postTime = $posts['time'];
    }

    $count = $db->query("SELECT COUNT(postID) FROM posts WHERE user='lizarbeth'");
    $countPosts = $count->fetch_column();
    

    //display own user posts and posts from friends
    // $user = $_SESSION['username'];
    //if username == $user && 
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
                        <p> ------------------------- </p>
                        <?php } ?>

                    <?php  
                    //display post information ?>
            </div> 
            </div>
        </div> 



    </body>
</html>