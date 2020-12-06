<style>
	.text-watak
	{
		width:100%;
		height:28px;
		background:peachpuff;
		border:0px solid grey;
		font-size:16px;
	}
</style>
<?php
//$tran_id = $_GET["tran_id"];
include 'con.php';
$query_clear_buffer = mysqli_query($con,"delete from watak_buffer");
$query_select = mysqli_query($con,"select * from auto_watak order by sno desc limit 1");
while($r = mysqli_fetch_array($query_select))
{
	$date = $r['date'];
	$freight = $r['freight'];
	$comm = $r['commission'];
	$truck_no = $r['truck_no'];
	$labour = $r['labour'];
	$postage = $r['postage'];
	$association = $r['association'];
	$t_exp  = $r['trading_exp'];
	$challan_no = $r['challan'];
}
//echo "hello";
/* beopari name ledger_id
 * manual challan no narration

  * expenses
 * gross
 * net


 * truck no ======
 * date date
 * */
?>
<datalist id = 'vvariety' >
<option>A/C</option>
<option>Dls</option>
<option>K. Dls</option>
<option>NK</option>
<option>Centrose</option>
<option>Khubani</option>
<option>Mrj</option>
<option>Chamoora</option>
<option>G Dls</option>
</datalist>
<datalist id = 'type' >
<option>Gift/5L</option>
<option>Gift/4L</option>
<option>Gift/3L</option>
<option>Top/5L</option>
<option>Top/4L</option>
<option>TG/4,5L</option>
<option>TG/3L</option>
<option>SF/3L</option>

<option>KB</option>
</datalist>
<form action = "createwatak.php" onsubmit = 'return false;form_submit(this);' method = "GET">
<input type = "text" name = "tran_id" style = 'display:none;' id = "tran_id"/>
<table style = 'width:100%;border-collapse:collapse;' border = "0">
	<tr><td style = 'width:240px;'>
	<input type = "text" style = "display:none;" name = "ledger_id" id = "ledger_id"/>
<table style = 'width:100%;border-collapse:collapse;' border = "0">
<tr><td><input id = 'date' name = 'date' type = 'date' class = 'text-watak' value = "<?php echo $date;?>"/></td></tr>
<tr><td><input id = 'marka' name = 'marka' type = 'text' class = 'text-watak' placeholder = "marka"/></td></tr>
<tr><td><span style = 'min-width:180px;background:peachpuff;height:28px;padding:5px 21px 5px 5px;'>Challan #</span><input style = 'width:56%;text-align:right;padding-right:5px;' id = 'challan' name = 'challan' class = 'text-watak' placeholder = "challan / receipt" value = '<?php echo $challan_no;?>'/></td></tr>
<tr><td><span style = 'min-width:180px;background:peachpuff;height:28px;padding:5px 5px;'>Truck #</span><input style = 'width:70%;text-align:right;padding-right:5px;' id = 'truck' name = 'truck' class = 'text-watak' placeholder = "truck no" value = "<?php echo $truck_no;?>"/></td></tr>
<tr><td><input name = 'party' class = 'text-watak' placeholder = "Party Name" id = 'party'/></td></tr>
<tr><td><span style = 'min-width:180px;background:peachpuff;height:28px;padding:5px 20px 5px 5px;'>Freight : </span><input style = 'width:58%;text-align:right;padding-right:5px;' id = 'freight' name = 'freight' class = 'text-watak' placeholder = "freight per peti" value = '<?php echo $freight;?>' title = "freight per peti"/></td></tr>
<tr><td><span style = 'min-width:180px;background:peachpuff;height:28px;padding:5px 11px 5px 5px;'>Commission :</span><input style = 'width:47%;text-align:right;padding-right:5px;' id = 'comm' name = 'comm' class = 'text-watak' placeholder = "commision in %" title = "commision in %" value = '<?php echo $comm;?>'/></td></tr>
<tr><td><span style = 'min-width:180px;background:peachpuff;height:28px;padding:5px 26px 5px 5px;'>Labour :</span><input style = 'width:57%;text-align:right;padding-right:5px;' id = 'labour' name = 'labour' class = 'text-watak' placeholder = "labour / peti" title = "labour / peti" value = '<?php echo $labour;?>'/></td></tr>
<tr><td><span style = 'min-width:180px;background:peachpuff;height:28px;padding:5px 22px 5px 5px;'>Postage :</span><input style = 'width:57%;text-align:right;padding-right:5px;' id = 'postage' name = 'postage' class = 'text-watak' placeholder = "postage" title  = "postage" value = '<?php echo $postage;?>'/></td></tr>
<!--<tr><td><input name 'texp' class = 'text-watak' placeholder = "trading exp / peti" title = "trading exp / peti" value = "<?php echo $t_exp;?>"/></td></tr>-->

<tr><td><span style = 'min-width:180px;background:peachpuff;height:28px;padding:5px 1px 5px 5px;'>Association :</span><input style = 'width:55%;text-align:right;padding-right:5px;' id = 'ass' name = 'ass' class = 'text-watak' placeholder = "association / peti" title = "association / peti" value = '<?php echo $association;?>'/></td></tr>
<tr><td><span style = 'min-width:180px;background:peachpuff;height:28px;padding:5px 0px 5px 5px;'>V. Expenses :</span><input style = 'width:54%;text-align:right;padding-right:5px;' id = 'texp' name = 'texp' class = 'text-watak' placeholder = "V exp. / peti" title = "trading exp. / peti" value = '<?php echo $t_exp;?>'/></td></tr>
<tr><td></td></tr>
</table>
</td>
<td style = 'text-align:top;'>
<table style = 'width:100%;border-collapse:collapse;' border = "0">
		<tr style = ''><td><input type = 'text' placeholder = 'Peti' oninput = "lock_other('half')" name = 'peti' id= 'peti' style = 'width:40px'/></td><td><input style = 'width:40px' type = 'text' id = 'half' oninput = 'lock_other("peti")' placeholder= 'Half' name = 'half'/></td><td><input type = 'text' style = 'width:150px;' name = 'variety' id = 'variety' list = 'vvariety' placeholder = 'Variety'/></td><td><input type = 'text' style = 'width:150px;' list = 'type' placeholder = 'grade / layer' id = 'quality' name= 'quality'/></td><td><input type = 'text' style = 'width:50px' placeholder = 'Rate' onkeyup = "if(event.keyCode == 13) fill_amount()" name = 'rate' id = 'rate' /></td><td><input name = 'amount' style = 'width:80px;' id = 'amount' type = 'text' disabled/></td></tr>
<!--		<tr style = 'color:brown;background:peachpuff;font-weight:bold;'><td >Peti</td><td>Half</td><td style = 'width:150px;'>Variety</td><td>Grade / layer</td><td>Rate</td><td style = 'width:50px;'>Amount</td></tr>-->
		<tr><td colspan = '5'></td><td id = "button_tab"><input onclick = "fill_amount()" type = 'button' value = "add Items"/></td></tr>
</table>

<!--	<div style = "display:none;" id = "but_swap"><button onclick = "fill_amount() ">Add items</button></div>-->
	<div id= 'watak-pod'>
	</div>

</td>
</tr>
</table>
</form>
