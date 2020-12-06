<?php
session_start();
$username = $_POST["username"];
$password = $_POST["password"];
include 'con.php';
$username = stripslashes($username);
$password = stripslashes($password);
//$username = mysql_real_escape_string($username);
//$password = mysql_real_escape_string($password);
$query  = mysqli_query($con,"select * from users where username = '$username' and password = '$password'");
while($rowPass = mysqli_fetch_array($query))
{
	$_SESSION["id"] = $rowPass['id'];
	$_SESSION["privilages"] = $rowPass['privilages'];
}
$count = mysqli_num_rows($query);
if($count == 1)
{
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password;

//	echo "login successful";
	header('location:home.php');
}
else
{
	header("location:index.html");
}
?>
