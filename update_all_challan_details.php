<?php 
include 'con.php';
$sno = $_REQUEST["sno"];
$total_freight = $_REQUEST["total_freight"];
$balance = $_REQUEST["balance"];
$advance = $_REQUEST["advance"];
$rate = $_REQUEST["rate"];
$query_select = mysqli_query($con,"select challan_id from challan_detail where sno = $sno");
while($r = mysqli_fetch_array($query_select))
{
$challan = $r['challan_id'];
}
echo $sno." ".$rate." ".$advance;

$query= mysqli_query($con,"update challan_detail set fr_rate = '$rate',advance=((peti+(dabba/2))*$advance),total_freight=(peti+(dabba/2))*$rate,balance=advance-total_freight where challan_id = $challan");
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
