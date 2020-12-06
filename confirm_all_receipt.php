<?php 
session_start();
include 'con.php';
if($_SESSION['username'] ==  'admin')
{
$query = mysqli_query($con,"update receipt_detail set verify_flag = 1 ");
}
header('location:admin_page.php');
?>
