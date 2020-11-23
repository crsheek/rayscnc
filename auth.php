<?php
session_start();
$authenticated = false;

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
    // let the user access the main page
    $authenticated = true;
}
elseif(!empty($_POST['username']) && !empty($_POST['password']))
{
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    // let the user login
    $result = $db->login($username, $password);
    if ($result):
    	$_SESSION['LoggedIn'] = true;
    	$_SESSION['Username'] = true;
    	//set cookie to expire in 30 minutes
    endif;
}
else
{
    // display the login form
    include_once("login.php");
}

?>