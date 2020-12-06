<?php
$advance = $_REQUEST["advance"];
$tran_id = $_REQUEST["tran_id"]; 
include 'con.php';
$query = mysqli_query($con,"update truck_details set adv_to_driver = $advance where challan_no = $tran_id");
?>
