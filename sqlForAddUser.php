<?php
	date_default_timezone_set('America/Chicago');
	$database = new mysqli("localhost", "INFX371", "P*ssword", "friend");
	
	$user = trim($_POST['user']);
	$password = trim($_POST['password']);
	$fName = trim($_POST['FName']);
	$lName = trim($_POST['LName']);
	$email = trim($_POST['email']);
	$email2 = trim($_POST['email2']);
	
	$joined = date('Y-m-d');

	$num = rand(1, 4);
	$picture = "pp{$num}.jpg";
	

	
	if ($email != $email2){
		header( 'Location: AddUser.php?msg2' );
	}
	else{
		$hashed_password = password_hash($password, PASSWORD_DEFAULT); //password_hash adds salt by default
	
	
		$sql = "INSERT INTO users (username, password, firstName, lastName, email, pic, joined) 
				VALUES ('$user', '$hashed_password', '$fName', '$lName', '$email', '$picture','$joined')";
		if(!$database->query($sql)){
			header( 'Location: AddUser.php?msg' );
		}
		else{
			header( 'Location: AddUser.php' );
		}
	}
	

?>
