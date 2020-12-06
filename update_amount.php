<?php 
$field = $_REQUEST["field"];
$sno = $_REQUEST["sno"];
$new_value = $_REQUEST["new_value"];
//echo $field." ".$sno." ".$new_value;
//$con = mysqli_connect("localhost","root","password","farooq");
include 'con.php';
$query = mysqli_query($con,"update challan_detail set $field = '$new_value' where sno = '$sno' ");
//echo "update challan_detail set $field = '$new_value' where sno = '$sno'";
if($query)
echo "successful";
else
{
	//echo mysqli_error($con);
echo "unsuccessful";
}
?>
