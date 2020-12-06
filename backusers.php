<?php 
include 'con.php';
$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
$privilages = $_REQUEST["privilages"];
$id = $_REQUEST["id"];
$query = mysqli_query($con,"update users set username = '$username',password = '$password',privilages = '$privilages' where id = '$id'");
if($query)
{
	echo "successful";
}
else
{
	echo "unsuccessful";
}
//header('location:admin_page.php');
?>
