<?php
$peti = 0;
$half = 0;
$ledger_id = $_REQUEST["ledger_id"];
$watak_no = $_REQUEST["watak_no"];
$date = $_REQUEST["date"];
echo $date;
$party_id = $_REQUEST["party"];
//echo $party_id;
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

//echo $freight." ".$comm." ".$labour." ".$ass." ".$t_exp;


$peti = $_REQUEST["peti"];
$half = $_REQUEST["half"];
$variety = $_REQUEST["variety"];
$quality = $_REQUEST["quality"];
$rate = $_REQUEST["rate"];
$amount = $_REQUEST["amount"];


$total_amount = $total_qty * $rate;

include 'con.php';
//$query_watak_detail = mysqli_query($con,"insert into watak_detail(date,watak_no,marka,challan_id,party_name,truck_no,peti,dabba) values('$date',$tran_id,'$marka',$challan_no,'$party_id','$truck','$peti','$half')");
$update_ledger = mysqli_query($con,"update daybook set ledger_id = $ledger_id,date=\"$date\" where transaction_type = 9 and transaction_id = $watak_no"); 
echo mysqli_error($con);
$update_watak_detail = mysqli_query($con,"update watak_detail set date = '$date',ledger_id=$ledger_id,marka = '$marka',challan_id = '$challan_no',party_name = '$party_id',truck_no = '$truck',peti = (select sum(peti) from watak_items where watak_no = $watak_no),dabba = (select sum(dabba) from watak_items where watak_no = $watak_no),gross = (select sum(amount) from watak_items where watak_no = $watak_no) where watak_no = $watak_no");
echo mysqli_error($con);
//$update_watak_detail = mysqli_query($con,"update watak_detail set date = '$date',marka = '$marka',challan_id = '$challan_no',party_name = '$party_id',truck_no = '$truck' where watak_no = $watak_no");
//$update_postage 
//if($update_ledger)

//echo $peti." ".$half." ".$variety." ".$quality." ".$rate." ".$amount;
//echo $tran_id;


//$query_update_detail2 = mysqli_query($con,"update wata")


$query_select = mysqli_query($con,"select * from watak_detail where watak_no = $watak_no");
while($r = mysqli_fetch_array($query_select))
{
//	echo "";
//echo $r['peti'];
$total_qty = ($r['peti'] + ($r['dabba']/2));
$freight_value = $freight*$total_qty;
$comm_value = ($comm*$r['gross'])/100;
$ass_value = $total_qty * $ass;
$t_exp_value = $total_qty * $t_exp;
$lab_value = $total_qty * $labour;
}
echo $freight;
$query_expenses = mysqli_query($con,"update watak_expenses set amount = '$freight_value' where watak_no = $watak_no and expense_head = 'freight'");
$query_expenses = mysqli_query($con,"update watak_expenses set amount = '$postage' where watak_no = $watak_no and expense_head = 'postage'");
$query_expenses = mysqli_query($con,"update watak_expenses set amount = '$lab_value' where watak_no = $watak_no and expense_head = 'Labour'");
$query_expenses = mysqli_query($con,"update watak_expenses set amount = '$comm_value' where watak_no = $watak_no and expense_head = 'commission'");
$query_expenses = mysqli_query($con,"update watak_expenses set amount = '$ass_value' where watak_no = $watak_no and expense_head = 'association'");
$query_expenses = mysqli_query($con,"update watak_expenses set amount = '$t_exp_value' where watak_no = $watak_no and expense_head = 'trading Expenses'");

/*
$query_expenses = mysqli_query($con,"insert into watak_expenses(expense_head,amount,watak_no) values('commission','$comm_value',$tran_id)");
$query_expenses = mysqli_query($con,"insert into watak_expenses(expense_head,amount,watak_no) values('Labour','$lab_value',$tran_id)");
$query_expenses = mysqli_query($con,"insert into watak_expenses(expense_head,amount,watak_no) values('postage','$postage',$tran_id)");
$query_expenses = mysqli_query($con,"insert into watak_expenses(expense_head,amount,watak_no) values('association','$ass_value',$tran_id)");
$query_expenses = mysqli_query($con,"insert into watak_expenses(expense_head,amount,watak_no) values('trading Expenses','$t_exp_value',$tran_id)");
*/

//$query_update_gross = mysqli_query($con,"update watak_detail set gross = '$total_amount' where watak_no = '$tran_id'");
$query_update_expenses = mysqli_query($con,"update watak_detail set expenses = (select sum(amount) from watak_expenses where watak_no = \"".$watak_no."\") where watak_no = '$watak_no'");
$query_update_net = mysqli_query($con,"update watak_detail set net_amount = gross- (select sum(amount) from watak_expenses where watak_no = \"".$watak_no."\") where watak_no = '$watak_no'");

?>
