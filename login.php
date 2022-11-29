<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset = "UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="waterwiki.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cinzel|Fauna+One">
</head>

<body>

    <!-- Creates banner at the top of the page -->
    <div class="p-5 text-white text-center" id="heading">
        <h1><strong>Water Wiki</strong></h1>
        <p><strong>Welcome to the Wikipedia Page for all Types of Water!</strong></p>
    </div>

    <!-- Creates the body of the page that contains a large card -->
    <div class="container">
        <div class="card p-5 my-5" id="loginbox">
            <h2>Login: </h2>

            <!-- Creates the form for the user to login with -->
            <form action="authentication.php" method="post">
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="user" name="username" required></input></br>
                    <label for="user">Enter Username: </label>
                </div>

                <?php
                if(isset($_GET['msg2'])){
                    $message = "Username Does Not Exist";
                    echo $message;
                }
                ?>

                <div class="form-floating mb-3 mt-3">
                    <input type="password" name="pass" class="form-control" id="pwd"></input></br>
                    <label for="pwd">Enter Password: </label>
                </div>

                <?php
                if(isset($_GET['msg'])){
                    $message = "Incorrect Password";
                    echo $message;
                }
                ?>
                </br></br>
                <input type="submit" class="submitbtn" value="Submit"></input>
            </form>

            <!-- Adds a link to the sign up page if the user does not currently have an account -->
            <form action="AddUser.php" method="post">
                <input type="submit" class="submitbtn my-3" value="Sign Up"></input>
            </form>

        </div>
    </div>

    <!-- Creates the footer at the bottom of the page -->
    <div class="container-fluid mt-5 p-2 text-white text-center" id="footer">
        <p>Water Fanatics Inc.</p>
    </div>


</body>
</html>