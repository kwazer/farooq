<?php 
include 'con.php';
$sno = $_REQUEST["sno"];
$query = mysqli_query($con,"delete from watak_items where sno = $sno");
if($query)
echo "successful";
else
echo "unsuccessful";
?>
