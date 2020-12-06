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
$sno = $_REQUEST["sno"];
//echo $sno;
include 'con.php'
 
?>
<div "sub_main" style = "background:white;border-radius:10px;padding:10px;width:820px;">
	<big style = "font-size:28px;color:grey;letter-spacing:2px;" >Add new ledger</big><br><hr>
	<form method = "post" action= "backaddledger.php" onsubmit = "return submit_item(this);">
	<table style = "width:100%;">
		<tr><td style = "text-align:left;">Ledger Name</td><td><input autofocus type = "text" id = "led_name" name = "ledger_name"/></td></tr>
<?php 
if($sno == 2 or $sno == 6 or $sno == 8)
{
echo '		<tr><td style = "text-align:left;">Father Name</td><td><input  type = "text" id = "father_name" name = "father_name"/></td></tr>
<tr><td style = "text-align:left;">Address</td><td><input  type = "text" id = "address" name = "address"/></td></tr>
<tr><td style = "text-align:left;">Phone No</td><td><input type = "text" id = "phone_no" name = "phone_no"/></td></tr>
<tr><td style = "text-align:left;">Phone No 2</td><td><input type = "text" id = "phone_no_sec" name = "phone_no_sec"/></td></tr>';

if($sno == 6 or $sno == 8)echo 		'<tr><td style = "text-align:left;">Guarantor</td><td><input  type = "text" id = "guarantor" name = "guarantor"/></td></tr>';


else
{
echo 		'<tr><td style = "text-align:left;">Guarantor</td><td><input  type = "text" id = "guarantor" name = "guarantor"/></td></tr>
		
		<tr><td style = "text-align:left;">Guarantor Phone</td><td><input type = "text" id = "phone_2" name = "phone_2"/></td></tr>
		<tr><td style = "text-align:left;">Guarantor Phone 2</td><td><input type = "text" id = "gp2" name = "gp2"/></td></tr>';
	}
		//if($sno == 2)
echo		'<tr><td style = "text-align:left;">tenure</td><td><input type = "text" id = "payment_cycle" name = "payment_cycle" placeholder = "Enter D for Daily and M for Monthly"/></td></tr>';
	}
	?>
<!--		<tr><td style = "text-align:left;">Address</td><td>--><?php echo "<input type = \"text\" value = \"$sno\" id = \"led_type\" name = \"ledger_type\" style = \"display:none;\"/>";?><!--</td></tr>-->
		<tr><td style = "text-align:left;">opening balance</td><td><input type = "text" id = "led_balance" name = "opening_balance"/></td></tr>
		
		<!--<tr><td style = "text-align:left;">phone</td><td><input type = "text" id = "cell"/></td></tr>-->
		<tr><td style = ""></td><td style = "text-align:left;"><input type = "submit" value = "save" style = "letter-spacing:3px;background:white;border:1px solid grey;width:100px;"/></td></tr>
		
	</table> 
	</form>
</div>
