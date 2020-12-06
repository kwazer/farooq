<?php 
session_start();
if($_SESSION['id'] == 1)
{
include 'con.php';
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$privilages = $_REQUEST['privilages'];
$query = mysqli_query($con,"insert into users(username,password,privilages) values('$username','$password','$privilages')");
if($query)
{
echo "successful";
}
else
{
	echo "unsuccessful";
}
}
?>
