<?php
session_start();
if (!isset($_SESSION['userOutput'])) 
{
	header('Location: http://www.google.com/');
	exit(0);
}

echo "<p>Welcome back " .  $_SESSION["userOutput"] . "! </p>";
?>

<!DOCTYPE html>

<html lang = "en"> 

<head>

<title>Success</title>

<meta charset = "UTF-8">



<style>



p
{
	padding-top:350px;
	text-align:center;	
	font-size : 80px;

}


</style>


</head>


<div>

<body>



</body>
</html>







