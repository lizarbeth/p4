<?php
	$database = new mysqli("localhost", "INFX371", "P*ssword", "friend");
	
	$sql = "SELECT COUNT(*) AS Number FROM users";
	$query = $database->query($sql);
	$userCount = mysqli_fetch_assoc($query);

	$Username = $_POST['username'];
	$Password = $_POST['pass'];

	$x=1;
	while ($x-1 != $userCount['Number']){
		$sql2 = "SELECT * FROM users WHERE count=$x";
		$query2 = $database->query($sql2);
		$user = mysqli_fetch_assoc($query2);
		if ($Username == ($user['username'])){
			echo $user['password'];
			if(password_verify($Password, $user['password'])){
				session_start();
				$_SESSION["username"] = $Username;
				header( 'Location: dashboard.php' );
				break;
			}
			else{
				header( 'Location: login.php?msg' );
				break;
			}	
		}
		else{
			$x++;
		}
	}
	if ($x-1 == $userCount['Number']){header( 'Location: login.php?msg2' );}
?>