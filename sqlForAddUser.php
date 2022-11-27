<?php

	$database = new mysqli("localhost", "INFX371", "P*ssword", "friend");
	
	$user = trim($_POST['user']);
	$password = trim($_POST['password']);
	$confirmPassword = trim($_POST['confirmPassword']);
	$fName = trim($_POST['FName']);
	$lName = trim($_POST['LName']);
	$email = trim($_POST['email']);
	$email2 = trim($_POST['email2']);

	
	$num = rand(1, 4);
	$picture = "pp{$num}.jpg";
	
	if ($password != $confirmPassword){
		header( 'Location: AddUser.php?msg3' );
	}
	
	elseif ($email != $email2){
		header( 'Location: AddUser.php?msg2' );
	}
	else{
		$hashed_password = password_hash($password, PASSWORD_DEFAULT); //password_hash adds salt by default
	
	
		$sql = "INSERT INTO users (username, password, firstName, lastName, email, pic) 
				VALUES ('$user', '$hashed_password', '$fName', '$lName', '$email', '$picture')";
		if(!$database->query($sql)){
			header( 'Location: AddUser.php?msg' );
		}
		else{
			header( 'Location: AddUser.php' );
		}
	}
	
	

?>