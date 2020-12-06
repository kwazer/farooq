<?php
$peti = 0;
$half = 0;
$date = $_REQUEST["date"];
$party_id = $_REQUEST["party"];
echo $party_id;
$challan_no = $_REQUEST["challan"];
$marka = $_REQUEST["marka"];
$truck = $_REQUEST["truck"];
$post_tran = $_REQUEST["tran_id"];

$freight = $_REQUEST["freight"];
$comm = $_REQUEST["comm"];
$labour = $_REQUEST["labour"];
$postage = $_REQUEST["postage"];
$ass = $_REQUEST["ass"];
$t_exp = $_REQUEST["texp"];

$peti = $_REQUEST["peti"];
$half = $_REQUEST["half"];
$variety = $_REQUEST["variety"];
$quality = $_REQUEST["quality"];
$rate = $_REQUEST["rate"];
$amount = $_REQUEST["amount"];


$total_amount = $total_qty * $rate;


//echo $marka." ".$freight." ".$comm." ".$labour." ".$postage." ".$ass." ".$t_exp." ".$date;
//echo $date." ".$party_id." ".$challan_no;


include 'con.php';
$tran_id = 1;
//$query_init = mysqli_query($con,"select * from auto_watak limit 1");
$query_auto = mysqli_query($con,"insert into auto_watak(marka,date,challan,truck_no,party_name,freight,commission,labour,postage,association,trading_exp) values('$marka','$date','$challan_no','$truck','$party_id','$freight','$comm','$labour','$postage','$ass','$t_exp')");
$query_tran = mysqli_query($con,"select transaction_id from daybook where transaction_type = 9 order by transaction_id desc limit 1");
while($row = mysqli_fetch_array($query_tran))
{
	$tran_id = $row['transaction_id']+1;
}

//if($_REQUEST["tran_id"] != "")
//{
//	$tran_id = $post_tran;
//}
//else
//{
	$query = mysqli_query($con,"insert into daybook(date,transaction_type,transaction_id,narration) values('$date','9',$tran_id,'$challan_no')");
	if($query)
	echo "successful";
//}
//$query_list = mysqli_query($con,"insert into watak_items(peti,watak_no,variety,quality,rate,amount) values('$peti','$tran_id','$variety','$quality','$rate','$amount')");

//$query_list = mysqli_query($con,"insert into watak_items(peti,dabba,watak_no,variety,quality,rate,amount) values('$peti','$half','$tran_id','$variety','$quality','$rate','$total_amount')");
$update_buffer = mysqli_query($con,"update watak_buffer set watak_no = '$tran_id'");
$query_select = mysqli_query($con,"select sum(peti),sum(dabba),sum(amount) from watak_buffer");
while($row = mysqli_fetch_array($query_select))
{
	$peti = $row['sum(peti)'];
	$half = $row['sum(dabba)'];
	$total_amount = $row['sum(amount)'];
}
$query_watak_detail = mysqli_query($con,"insert into watak_detail(date,watak_no,marka,challan_id,party_name,truck_no,peti,dabba) values('$date',$tran_id,'$marka',$challan_no,'$party_id','$truck','$peti','$half')");
//$query_list = mysqli_query($con,"insert into watak_items (select * from watak_buffer)");
$query_list = mysqli_query($con,"insert into watak_items(watak_no,peti,dabba,variety,quality,rate,amount) (select watak_no,peti,dabba,variety,quality,rate,amount from watak_buffer)");

if($query_list)
{
//	$query_clear = mysqli_query($con,"delete from watak_buffer");
}

//echo $peti." ".$half." ".$variety." ".$quality." ".$rate." ".$amount;
echo $tran_id;
$total_qty = ($peti + ($half/2));
$freight_value = $freight*$total_qty;
$comm_value = ($comm*$total_amount)/100;
$ass_value = $total_qty * $ass;
$t_exp_value = $total_qty * $t_exp;
$lab_value = $total_qty * $labour;
//if($_REQUEST["tran_id"] == "")
//{
$query_expenses = mysqli_query($con,"insert into watak_expenses(expense_head,amount,watak_no) values('freight','$freight_value',$tran_id)");
$query_expenses = mysqli_query($con,"insert into watak_expenses(expense_head,amount,watak_no) values('commission','$comm_value',$tran_id)");
$query_expenses = mysqli_query($con,"insert into watak_expenses(expense_head,amount,watak_no) values('Labour','$lab_value',$tran_id)");
$query_expenses = mysqli_query($con,"insert into watak_expenses(expense_head,amount,watak_no) values('postage','$postage',$tran_id)");
$query_expenses = mysqli_query($con,"insert into watak_expenses(expense_head,amount,watak_no) values('association','$ass_value',$tran_id)");
$query_expenses = mysqli_query($con,"insert into watak_expenses(expense_head,amount,watak_no) values('trading Expenses','$t_exp_value',$tran_id)");
$query_update_gross = mysqli_query($con,"update watak_detail set gross = '$total_amount' where watak_no = '$tran_id'");
$query_update_expenses = mysqli_query($con,"update watak_detail set expenses = (select sum(amount) from watak_expenses where watak_no = \"".$tran_id."\") where watak_no = '$tran_id'");
$query_update_net = mysqli_query($con,"update watak_detail set net_amount = ($total_amount - (select sum(amount) from watak_expenses where watak_no = \"".$tran_id."\")) where watak_no = '$tran_id'");
//}
//else
//{
/*
$query_expenses =  mysqli_query($con,"update watak_expenses set amount = amount + $freight_value where watak_no = '$tran_id' and expense_head = 'freight'");
$query_expenses =  mysqli_query($con,"update watak_expenses set amount = amount + $comm_value where watak_no = '$tran_id' and expense_head = 'commission'");
$query_expenses =  mysqli_query($con,"update watak_expenses set amount = amount + $lab_value where watak_no = '$tran_id' and expense_head = 'Labour'");
$query_expenses =  mysqli_query($con,"update watak_expenses set amount = amount + $postage where watak_no = '$tran_id' and expense_head = 'postage'");
$query_expenses =  mysqli_query($con,"update watak_expenses set amount = amount + $ass_value where watak_no = '$tran_id' and expense_head = 'association'");
$query_expenses =  mysqli_query($con,"update watak_expenses set amount = amount + $t_exp_value where watak_no = '$tran_id' and expense_head = 'trading Expenses'");
$query_update_gross = mysqli_query($con,"update watak_detail set gross = gross + $total_amount where watak_no = '$tran_id'");
$query_update_expenses = mysqli_query($con,"update watak_detail set expenses = (select sum(amount) from watak_expenses where watak_no = \"".$tran_id."\") where watak_no = '$tran_id'");
$query_update_net = mysqli_query($con,"update watak_detail set net_amount = (gross - (select sum(amount) from watak_expenses where watak_no = \"".$tran_id."\")) where watak_no = '$tran_id'");
*/
//}
//$query_update_peti = mysqli_query($con,"udpate watak_detail set peti = '$peti'");
//$query_update_dabba = mysqli_query($con,"udpate watak_detail set dabba = '$half'");


//header("location:transactions.php");

?>
