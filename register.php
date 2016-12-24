<!DOCTYPE html>

<html lang = "en"> 

<head>

<title>Registration</title>

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
<a href="http://cs3380.rnet.missouri.edu/~rml3md/hw2/login.php/">Login Here</a>

<form method = "POST" name = "form">




Username
<br>
<input type = "text" name = "Username" value = "">
<br>


Password
<br>
<input type = "password" name = "Password" value = "">
<br>



<input type = "submit" name = "submit" style = "margin-top : 10px" value = "Register" >
</form>


</div>


</html>


<?php

if(isset($_POST['submit']))
{

	$link = mysqli_connect('localhost' , 'rml3md' , '7153f64' , 'rml3md') or die ( " line 58" . mysqli_connect_error());



	if(checkUsername($link) == 1)
	{
		echo"<div><p>Sorry! That username has been taken!</p></div>";
		exit(0);
	}



	$sql = 'INSERT INTO users (username, password) VALUES (?, ?)';


	if($stmt = mysqli_prepare($link , $sql))
	{

		mysqli_stmt_bind_param($stmt , 'ss' , $_POST['Username'] , $_POST['Password']) or die ("26");

		$usernamePHP = $_POST['Username'];
		$passwordPHP = $_POST['Password'];	


		if(strlen($passwordPHP) < 5 && $passwordPHP != "" )
		{
			echo "<div><p>Your password is not long enough!</p></div>";	
			exit(0);

		}

		if($usernamePHP == "" || $passwordPHP == "" )
		{
			echo "<div><p>You forgot to fill out a field!</p></div>";	
			exit(0);

		}


		if(mysqli_stmt_execute($stmt))
		{
			echo "<div><p>You successfully registered!</p></div>";	
		}

		else
		{
			echo "<div><p>An error occurred!</p></div>";	
		}
	}



	else
	{

		echo "<div><p>Statement did not execute</div></p>";
	}
}

function checkUsername($link)
{

	$sql = 'SELECT username FROM users WHERE username LIKE ?';

	$stmt = mysqli_prepare($link , $sql);

	mysqli_stmt_bind_param($stmt , 's' , $_POST['Username']) or die ("142");

	
	mysqli_stmt_execute($stmt);

	mysqli_stmt_store_result($stmt);

	if(mysqli_stmt_num_rows($stmt) != 0)
	{
		return 1;
	
	}
	
	return 0;


}



?>
