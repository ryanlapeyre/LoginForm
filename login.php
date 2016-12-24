<?php
session_start();
if (!isset($_SESSION['userOutput'])) {
	  $_SESSION['userOutput'] = 0;
}
?>
<!DOCTYPE html>

<html lang = "en"> 

<head>

<title>Login</title>

<meta charset = "UTF-8">



<style>



p , a , div ,input 
{
	text-align:center;
	font-size : 28px;

}


</style>


</head>


<div>

<body>
<a href="http://cs3380.rnet.missouri.edu/~rml3md/hw2/register.php/">Register Here</a>

<form method = "POST" name = "form">




Username
<br>
<input type = "text" name = "Username" value = "">
<br>


Password
<br>
<input type = "password" name = "Password" value = "">
<br>


<input type = "submit" name = "submit"  value = "Login"/>
</form>


</div>

</body>

</html>


<?php

if(isset($_POST['submit']))
{

	$link = mysqli_connect('localhost' , 'rml3md' , '7153f64' , 'rml3md') or die ( " line 58" . mysqli_connect_error());

	$sql = 'SELECT username, password FROM users WHERE username LIKE ? AND password LIKE ?';

	if($stmt = mysqli_prepare($link , $sql))
	{



		mysqli_stmt_bind_param($stmt , 'ss' , $_POST['Username'] , $_POST['Password']) or die ("26");

		$usernamePHP = $_POST['Username'];
		$passwordPHP = $_POST['Password'];	
		$_SESSION['userOutput'] = $usernamePHP; 


		if(strlen($passwordPHP) < 5 && $passwordPHP != "" )
		{
			echo "<p>Your password is not long enough!</p>";	
			exit(0);

		}

		if($usernamePHP == "" || $passwordPHP == "" )
		{
			echo "<p>You forgot to fill out a field!</p>";	
			exit(0);

		}


		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);


		if(mysqli_stmt_num_rows($stmt) == 1)
		{

			echo "<p>You successfully logged in!</p>";
			sleep(2);
			echo '<script type = "text/javascript"> window.location = "http://cs3380.rnet.missouri.edu/~rml3md/hw2/success.php"</script>';

		}



		else
		{
			echo "<p>You are not registered!</p>";	
		}

	}
	else
	{
		echo "statment could not execute";
	}



}

?>



