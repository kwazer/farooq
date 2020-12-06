<?php
$tran_id = $_REQUEST["tran_id"];
include 'con.php';
$query  = mysqli_query($con,"update goods_details set status = 1 where tran_id = $tran_id");
?>
