<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset = "UTF-8">
	<link href="style.css" rel="stylesheet">
</head>

<title>AddUser</title>
<body>

	<?php
		if(isset($_GET['msg'])){
        		$message = "Username or Email already Exist";
        		echo $message;
    		}
	?>	
	<h2>Create New User: </h2>
	
	<form action="sqlForAddUser.php" method="post">
		<input type="text" placeholder="Username" class="text" name="user" required></input></br></br>

		<input type="text" placeholder="Password" class="password" name="password" required></input></br></br>

		<input type="text" placeholder="First Name" class="FName" name="FName" required></input></br></br>

		<input type="text" placeholder="Last Name" class="LName" name="LName" required></input></br></br>

		<input type="email" placeholder="Email" class="email" name="email" required></input></br></br>

		<input type="email" placeholder="Confirm Email" class="email" name="email2" required></input></br>

		<?php
			if(isset($_GET['msg2'])){
        			$message = "email is not the same";
        			echo $message;
    			}
		?>
		</br>
		<input type="submit" value="submit"></input>
	</form>

</body>
</html>