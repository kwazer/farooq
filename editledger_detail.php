<style>
	#sub_main
	{
		background:white;
		border-radius:10px;
	}
	input 
	{
		width:250px;
		height:26px;
	}
	td
	{
		
		color:grey;
	}
</style>
<?php
session_start();
if($_SESSION["id"] == 1)
{

//$sno = $_REQUEST["sno"];
$led_no = $_REQUEST["led_id"];
$led_name = $_REQUEST["led_name"];
//echo $sno;
include 'con.php';
 $query_select = mysqli_query($con,"select * from ledgers where ledger_id = $led_no");
 while($row_select = mysqli_fetch_array($query_select))
 {
	 $ledger_type = $row_select['ledger_type'];
	 $opening_ba = $row_select['opening_balance'];
	 $open_date = $row_select['ledger_date'];
	 $sub_info = $row_select['sides'];
$account = $row_select['account'];
	 //echo $open_date;
 }
// echo "ledger Edit Details";
 ?>

<div "sub_main" style = "background:white;border-radius:10px;padding:10px;width:820px;">
	<big style = "font-size:28px;color:grey;letter-spacing:2px;" >Edit ledger</big><br><hr>
	<p><span>Ledger ID</span>	<?php echo "$led_no";?>
</p>
	<form method = "post" action= "backeditledger.php" onsubmit = "return submit_item(this);">
	<table style = "width:100%;">
		<input type = "text" value = "<?php echo $led_no;?>" style = "display:none;" name = "led_id"/>		
		<input type = "text" value = "<?php echo $ledger_type;?>" style = "display:none;" name = "ledger_type"/>
			
		<tr><td style = "text-align:left;">Ledger Name</td><td><input autofocus type = "text" id = "led_name" name = "ledger_name" value = "<?php echo $led_name ;?>"/></td></tr>
		<tr><td style = "text-align:left;">Aliases</td><td><input type = "text" id = "sides" name = "sides" value = "<?php echo $sub_info ;?>"/></td></tr>
<?php 
if($ledger_type == 2 or $ledger_type == 6 ){
$query = mysqli_query($con,"select * From ledger_details join ledgers using (ledger_id) where ledger_id = $led_no");
//print_r($query);
	while ($row=mysqli_fetch_array($query))
{
//	echo $row['father_name'];
//	echo $row['address'];
if($ledger_type == 2 or $ledger_type == 6)

echo "		<tr><td style = \"text-align:left;\">Father Name</td><td><input  type = \"text\" id = \"father_name\" name = \"father_name\" value = '".$row['father_name']."'/></td></tr>
<tr><td style = \"text-align:left;\">Address</td><td><input  type = \"text\" id = \"address\" name = \"address\" value = '".$row['address']."'/></td></tr>";
echo "<tr><td style = \"text-align:left;\">Phone No</td><td><input type = \"text\" id = \"phone_no\" name = \"phone_no\" value = '".$row['phone_no']."'/></td></tr>
<tr><td style = \"text-align:left;\">Phone No 2</td><td><input type = \"text\" id = \"phone_no_sec\" name = \"phone_no_sec\" value = '".$row['phone_sec']."'/></td></tr>";

	
if($ledger_type == 2)
{		
	echo "<tr><td style = \"text-align:left;\">Guarantor</td><td><input  type = \"text\" id = \"guarantor\" name = \"guarantor\" value = '".$row['guarantor']."'/></td></tr>";
echo 	"<tr><td style = \"text-align:left;\">Guarantor Phone</td><td><input type = \"text\" id = \"phone_2\" name = \"phone_2\" value = '".$row['phone_2']."'/></td></tr>
		<tr><td style = \"text-align:left;\">Guarantor Phone 2</td><td><input type = \"text\" id = \"gp2\" name = \"gp2\" value = '".$row['gp2']."'/></td></tr>";
	}
	else
	echo "<tr><td style = \"text-align:left;\">Statement Issued On</td><td><input  type = \"text\" id = \"guarantor\" name = \"guarantor\" value = '".$row['guarantor']."'/></td></tr>";
		

	
if($ledger_type == 2)		
echo "		<tr><td style = \"text-align:left;\">EMI Installment</td><td><input type = \"text\" id = \"emi_installment\" name = \"emi_installment\" value = '".$row['installment']."'/></td></tr>";

echo "		<tr><td style = \"text-align:left;\">tenure</td><td><input type = \"text\" id = \"payment_cycle\" name = \"payment_cycle\" value = '".$row['ledger_tenure']."'/></td></tr>";
echo "		<tr><td style = \"text-align:left;\">Ledger Folio</td><td><input type = \"text\" id = \"folio\" name = \"folio\" value = '".$row['folio']."'/></td></tr>";
echo "		<tr><td style = \"text-align:left;\">Notes</td><td><input type = \"text\" id = \"narration\" name = \"narration\" value = '".$row['narration']."'/></td></tr>";

}
}
echo "<tr><td style = \"text-align:left;\">Account No</td><td><input type = \"text\" id = \"account\" name = \"account\" value = '".$account."'/></td></tr>";
echo "		<tr><td style = \"text-align:left;\">opening balance</td><td><input type = \"text\" id = \"led_balance\" name = \"opening_balance\" value = '".$opening_ba."'/></td></tr>";
echo "		<tr><td style = \"text-align:left;\">opening Date</td><td><input type = \"date\" id = \"open_date\" name = \"open_date\" value = '".$open_date."'/></td></tr>";
	
		echo '
				<tr><td style = ""></td><td style = "text-align:left;"><input type = "submit" value = "save" style = "letter-spacing:3px;background:white;border:1px solid grey;width:100px;"/></td></tr>';


}
?>		
	</table> 
	</form>
</div>
