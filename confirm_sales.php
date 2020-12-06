<?php
include 'con.php';
$led_id = $_GET["led_id"];
$sno = $_REQUEST["type_id"];
$purchase_bill_no = $_REQUEST["pur_bil_no"];
$emiAmount = $_REQUEST["emiAmount"];
$receipt_narration = $_REQUEST["receipt_narration"];
echo $receipt_narration;
$date = $_REQUEST["date"];
$customer = $_REQUEST["cust"];
echo $sno;
echo $emiAmount;
echo $date;
echo $customer;
//echo $sno;
//if(ISSET($led_id))
//$query_insert_bill = mysqli_query($con,"insert into bills(bill_date,sale_type) values(current_timestamp,50)");
//else
$query_select  = mysqli_query($con,"select * From daybook where transaction_type = '$sno' order by transaction_id desc limit 1");

while($row = mysqli_fetch_array($query_select))
{
	$bill_no = $row['transaction_id'] + 1;
//	$snow = $row['sno'];
}
if(!isset($bill_no))
{
	$bill_no = 1;
}
//echo $bill_no;

/*
if($sno == 1)
{
$query_insert_bill = mysqli_query($con,"insert into daybook(date,transaction_type,fund_flow,transaction_id,ledger_id,narration) values(current_timestamp,$sno,0,$bill_no,'$led_id','$purchase_bill_no')"); //~remember to change the ledger here ~ hint :-> always enter the first ledger as cash
$query_showdown =  mysqli_query($con,"insert into purchase_detail(bill_id,uid,price,amount,qty,date) select $bill_no,item_id,cost_price,qty*cost_price as total,qty,curdate() from bill_buffer join items on bill_buffer.uid = items.item_id");
}*/
if($sno == 1)
{
$query_insert_bill = mysqli_query($con,"insert into daybook(date,transaction_type,fund_flow,transaction_id,ledger_id,narration,log_date) values(str_to_Date('".$date."','%d-%m-%Y'),$sno,1,$bill_no,'$led_id','$receipt_narration',CURDATE())"); //~remember to change the ledger here ~ hint :-> always enter the first ledger as cash

//$query_set_installment = mysqli_query($con,"update ledger_details set installment = installment + $emiAmount where ledger_id = $led_id");
//$query_update_installment = mysqli_query($con,"insert into emi_detail(ledger_id)")
$query_showdown =  mysqli_query($con,"insert into purchase_detail(bill_id,uid,price,amount,qty,date) select $bill_no,item_id,amount,qty*amount as total,qty,str_to_Date('".$date."','%d-%m-%Y') from bill_buffer join items on bill_buffer.uid = items.item_id");
}
if($sno == 10)
{


$query_insert_bill = mysqli_query($con,"insert into daybook(date,transaction_type,fund_flow,transaction_id,ledger_id,narration,log_date) values('$date',$sno,1,$bill_no,'$led_id','$receipt_narration',CURDATE())"); //~remember to change the ledger here ~ hint :-> always enter the first ledger as cash

//$query_set_installment = mysqli_query($con,"update ledger_details set installment = installment + $emiAmount where ledger_id = $led_id");
//$query_update_installment = mysqli_query($con,"insert into emi_detail(ledger_id)")
$query_showdown =  mysqli_query($con,"insert into baardana_detail(bill_id,uid,price,amount,qty,date) select $bill_no,item_id,amount,qty*amount as total,qty,'$date' from bill_buffer join items on bill_buffer.uid = items.item_id");

}
if($sno == 3)
{
$query_insert_bill = mysqli_query($con,"insert into daybook(date,transaction_type,fund_flow,transaction_id,ledger_id,narration,log_date) values(str_to_Date('".$date."','%d-%m-%Y'),$sno,1,$bill_no,'$led_id','$receipt_narration',CURDATE())"); //~remember to change the ledger here ~ hint :-> always enter the first ledger as cash

$query_set_installment = mysqli_query($con,"update ledger_details set installment = installment + $emiAmount where ledger_id = $led_id");
//$query_update_installment = mysqli_query($con,"insert into emi_detail(ledger_id)")
$query_showdown =  mysqli_query($con,"insert into sale_detail(bill_id,uid,price,amount,qty,date) select $bill_no,item_id,amount,qty*amount as total,qty,str_to_Date('".$date."','%d-%m-%Y') from bill_buffer join items on bill_buffer.uid = items.item_id");
}
if($sno == 2)
{
$query_insert_bill = mysqli_query($con,"insert into daybook(date,transaction_type,fund_flow,transaction_id,log_date) values(current_timestamp,$sno,1,$bill_no,curdate())"); //~remember to change the ledger here ~ hint :-> always enter the first ledger as cash
$query_showdown2 =  mysqli_query($con,"insert into bill_detail(bill_id,uid,price,amount,qty,date) select $bill_no,item_id,amount,qty*amount as total,qty,CURDATE() from bill_buffer join items on bill_buffer.uid = items.item_id");
//$query_showdown =  mysqli_query($con,"insert into bill_detail(bill_id,uid,price,amount,qty,date) select $bill_no,item_id,amount,qty*amount as total,qty,str_to_Date('".$date."','%d-%m-%Y') from bill_buffer join items on bill_buffer.uid = items.item_id");


}

//if(!$snow)
//{
	$query_snow = mysqli_query($con,"select * From daybook where transaction_type = '$sno' order by transaction_id desc limit 1");
	while($row_snow = mysqli_fetch_array($query_snow))
	{
		$snow = $row_snow['sno'];
//		echo $snow;
	}
//}
//if($led_id != "")
//{


//}
//else
//{
//}
if($sno == 1)
$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from purchase_detail where bill_id = '$bill_no') where sno = '$snow'");
if($sno == 10)
$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from baardana_detail where bill_id = '$bill_no') where sno = '$snow'");
if($sno == 2)
{
//$queryCreateReceipt = mysqli_query($con,"insert into daybook(date,transaction_type,fund_flow,transaction_id,ledger_id,narration) select curdate(),'4','0',transaction_id + 1,'$led_id','$snow' from daybook where transaction_type = 4 order by sno desc limit 1");
$queryinsertcust = mysqli_query($con,"insert into sale_ledgers(ledger_name,sno,address,phone_no) values('$customer',$snow,'$emiAmount',$receipt_narration)");
$queryselectcust = mysqli_query($con,"select * from sale_ledgers order by ledger_id desc limit 1");
while($rowcust = mysqli_fetch_array($queryselectcust))
{
	$led_cust = $rowcust['ledger_id'];
}
$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from bill_detail where bill_id = '$bill_no') where sno = '$snow'");
$query_update_sum = mysqli_query($con,"update daybook set ledger_id = $led_cust where sno = '$snow'");
}
if($sno == 3)
$query_update = mysqli_query($con,"update daybook set amount = (select sum(amount) from sale_detail where bill_id = '$bill_no') where sno = '$snow'");
if($query_update)
{
	echo "successful";
	if($sno == 1)
	$query_update_inventory = mysqli_query($con,"update items join bill_buffer on items.item_id = bill_buffer.uid set quantity = quantity + qty");
	else
	$query_update_inventory = mysqli_query($con,"update items join bill_buffer on items.item_id = bill_buffer.uid set quantity = quantity - qty");
	$query_delete = mysqli_query($con,"delete from bill_buffer");
}
else
{
	echo "unsuccessful";
}
?>
