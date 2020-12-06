<?php 
include 'con.php';
$sno = $_REQUEST["sno"];
$total_freight = $_REQUEST["total_freight"];
$balance = $_REQUEST["balance"];
$advance = $_REQUEST["advance"];
$rate = $_REQUEST["rate"];
$query= mysqli_query($con,"update challan_detail set fr_rate = '$rate',advance='$advance',balance='$balance',total_freight='$total_freight' where sno = $sno");
//$query_select = mysqli_query($con,"select challan_id from challan_detail where sno = $sno");
//while($r = mysqli_fetch_array($query_select))
//{
//$challan = $r['challan_id'];
//}
//$query_update_all = mysqli_query($con,"update challan_detail set fr_rate = '$rate',advance = '$advance'"
if($query)
echo "succesful";
else
echo "unsuccessful;";
?>
