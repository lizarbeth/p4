<?php

$database = new mysqli("localhost", "INFX371", "P*ssword", "wiki");

$user = $_POST['user'];
$password = $_POST['password'];
$fName = $_POST['FName'];
$lName = $_POST['LName'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];


$hashed_password = password_hash($password, PASSWORD_DEFAULT); //password_hash adds salt by default


$sql = "INSERT INTO users (username, password, firstName, lastName, email, birthday) 
			VALUES ('$user', '$hashed_password', '$fName', '$lName', '$email', '$birthday')";
if(!$database->query($sql)){
    header( 'Location: AddUser.php?msg' );
}
else{
    header( 'Location: AddUser.php' );
}

?>
