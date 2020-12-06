<?php 
$name = $_GET["name"];
include 'con.php';
$query = mysqli_query($con,"select page_name from pages where page_name like '%$name%' or search_name like '%$name%'limit 1");
while($row = mysqli_fetch_array($query))
{
$address = $row['page_name'];
}
if($address)header("location:".$address.".php");
else header("location:page_not_found.php?name=".$name);
?>
