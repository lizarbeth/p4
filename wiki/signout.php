<?php
//removes session variables, destroys session, and redirects back to the login page.
session_start();
session_unset();
session_destroy();
header('Location: index.php');

?>
