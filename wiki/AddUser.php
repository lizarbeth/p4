<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset = "UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="waterwiki.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cinzel|Fauna+One">
</head>

<title>Login</title>
<body>
    <!-- Adds banner at the top of the page -->
    <div class="p-5 text-white text-center" id="heading">
        <h1><strong>Water Wiki</strong></h1>
        <p><strong>Welcome to the Wikipedia Page for all Types of Water!</strong></p>
    </div>

    <?php
    if(isset($_GET['msg'])){
        $message = "Username  or Email already Exist";
        echo $message;
    }
    ?>

    <!-- Creates the container that is the main body of the page -->
    <div class="container">
        <!-- Creates a card that contains the form for users to create an account -->
        <div class="card p-5 my-5" id="adduserloginbox">
            <h2>Create New User: </h2>

            <form action="sql.php" method="post">
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="user" name="user" required></input>
                    <label for="user">Enter username: </label>
                </div>

                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="pwd" name="password" required></input>
                    <label for="pwd">Enter Password: </label>
                </div>

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
                    <input type="date" class="form-control" id="birthday" name="birthday" required></input></br></br>
                    <label for="birthday">Enter Birthday: </label>
                </div>


                <input type="submit" class="submitbtn" value="Submit"></input>
            </form>

            <!-- Creates a button for users to go back to the login page -->
            <form action="index.php" method="post">
                <input type="submit" class="submitbtn my-3" value="Back to Login"></input>
            </form>


        </div>
    </div>

    <!-- Creates the footer at the bottom of the page -->
    <div class="container-fluid mt-5 p-2 text-white text-center" id="footer">
        <p>Water Fanatics Inc.</p>
    </div>

</body>
</html>
