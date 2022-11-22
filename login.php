<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset = "UTF-8">
	<link href="style.css" rel="stylesheet">
</head>

<body>
	<form action="authentication.php" method="post">
	
		<input type="text" placeholder="Enter Username" class="text" name="username" required></input></br></br></br>
		<?php
			if(isset($_GET['msg2'])){
        			$message = "Username Does Not Exist";
        			echo $message;
    			}
		?>		

		<input type="password" placeholder="Enter Password" name="pass"></input></br></br>
		<?php
			if(isset($_GET['msg'])){
        			$message = "Incorrect Password";
        			echo $message;
    			}
		?>
		</br></br>
		<input type="submit" value="submit"></input>
	</form>
