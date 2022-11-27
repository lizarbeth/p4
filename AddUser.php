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
    <title>Watering Hole Sign Up</title>
</head>

<title>AddUser</title>
<body>

    <div class="p-5 text-white text-center" id="heading">
        <img src="largelogo.png" alt="Logo">
    </div>


    <div class="container d-flex justify-content-center">
        <div class="card p-5 my-5" id="adduserloginbox">
            <?php
            if(isset($_GET['msg'])){
                $message = "Username or Email already Exist";
                echo $message;
            }
            ?>

            <div class="d-flex justify-content-center m-5">
                <img src="smallicon.png" alt="Logo">
            </div>

            <h2>Create New User: </h2>

            <form action="sqlForAddUser.php" method="post">
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="user" name="user" required>
                    <label for="user">Enter username: </label>
                </div>

                <div class="form-floating mb-3 mt-3" >
                    <input type="text" class="form-control" id="pwd" name="password" required></input>
                    <label for="pwd">Enter Password: </label>
                </div>

                <div class="form-floating mb-3 mt-3" >
                    <input type="text" class="form-control" id="pwd" name="confirmPassword" required></input>
                    <label for="pwd">Enter Password: </label>
                </div>
			<?php
                		if(isset($_GET['msg3'])){
                    		$message = "Password is not the same";
                    		echo $message;
                		}
			?>

                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="fname" name="FName" required></input>
                    <label for="fname">Enter First Name: </label>
                </div>

                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="lname" name="LName" required></input>
                    <label for="lname">Enter Last Name: </label>
                </div>

                <div class="form-floating mb-3 mt-3">
                    <input type="email" class="form-control" id="email" name="email" required></input>
                    <label for="email">Enter email: </label>
                </div>

                <div class="form-floating mb-3 mt-3">
                    <input type="email" class="form-control" id="email2" name="email2" required></input></br>
                    <label for="email2">Confirm Email: </label>
                </div>

                <?php
                if(isset($_GET['msg2'])){
                    $message = "email is not the same";
                    echo $message;
                }
                ?>

                <input type="submit" class="submitbtn" value="Submit"></input>

            </form>


            <!-- Creates a button for users to go back to the login page -->
            <form action="login.php" method="post">
                <input type="submit" class="submitbtn my-3" value="Back to Login"></input>
            </form>


        </div>

    </div>


    <!-- Creates the footer at the bottom of the page -->
    <footer class="container-fluid mt-5 p-3 text-center">
        <h5><strong>Water Fanatics Inc.</strong></h5>
        <h5><strong><a class="linkdecorationrm" href="wiki/home.php">Like water? Learn more on our Wiki!</a></strong></h5>
    </footer>

</body>
</html>
