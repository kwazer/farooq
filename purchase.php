<?php
session_start();
include 'con.php';
$sno = $_REQUEST["type_id"];
$ledger_type = $_REQUEST["type_name"];

$query_se = mysqli_query($con,"select * From daybook where transaction_type = '$sno' order by transaction_id desc limit 1");
while($row_se = mysqli_fetch_array($query_se))
{
	
	$bil_no = $row_se['transaction_id'];
}
	if(isset($bil_no))
	$bil_no = $bil_no + 1;
	else
	$bil_no = 1;

?>
<style>
	.lisst
	{
		color:navy;
		text-align:left;
	}
	.list_hover:hover
	{
		background:blue;
	}
	
</style>
<script>
	
//function del()
//{
//	location.href = 'deleteitem.php?item_id='+item_id;
//}

</script>
<div id = "main-window" style = "width:780px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
$query_date = mysqli_query($con,"select DATE_FORMAT(date,'%d-%m-%Y') as date from daybook where transaction_type = '$sno' order by sno desc limit 1");
while($rowDate = mysqli_fetch_array($query_date))
{
	$date_fill = $rowDate['date'];
}
$array_ledger = array();

$query_ledger = mysqli_query($con,"select * from ledgers where ledger_type between 3 and 4");
while($row_ledger = mysqli_fetch_array($query_ledger))
{
	$array_ledger[] = $row_ledger;
}
//print_r($array_ledger);

?>
<!--<ul style = 'list-style:none;display:block;background:black;color:ivory;padding:4px;font-size:13px;'>
	<li style = 'display:inline;border:1px solid black;padding:3px 8px;margin:0px;' class = 'list_hover'>By Barcode</li>
	<li style = 'display:inline;border:1px solid black;padding:3px 8px;margin:0px;' class = 'list_hover'>By Name</li>
</ul>-->
<?php

//{
//echo "<form action = \"back".$ledger_type.".php\" method = \"post\" onsubmit = \"if(event.keyCode == 13){return false;} else{return submit_sale(this);}\">";
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='transactions.php';\">Back</span><br><hr>";

echo "<input type = 'text' name = 'transaction_type' id = 'transaction_type' value = '".$sno."' style = 'display:none;'/>";
echo "<input type = 'text' name = 'bill_no' id = 'serial_no' value = '".$bil_no."' style = 'display:none;' />";
echo "<input type = 'text' name = 'uid' id = 'uid' style = 'display:none;'/>";
echo "<input type = 'text' name = 'other_ledger' id = 'other_ledger' style = 'display:none;'/>";
echo "<table border = \"0\" style = \"border-collapse:collapse;width:100%;\">";
echo "<tr><td style = 'text-transform:capitalize;color:brown;' class = 'lisst'>".$ledger_type." #".$bil_no."</td></tr>";
//ledger search as you type
echo "<tr><td class = 'lisst'><span>Date : </span></td><td><input type = 'text' name = 'date' style = 'width:100%;height:28px;' id= 'date'  placeholder = 'DD-MM-YYYY' value = '$date_fill'/></td>";
echo "<td class = 'lisst'><span>Bill No : </span></td><td><input type = 'text' name = 'narration' style = 'width:100%;height:28px;' id= 'receipt_narration' /></td></tr>";
echo "<tr><td class = 'lisst' ><span>Party Name : </span></td><td >";

//echo "<table id = \"lero\" tabindex = \"444\" style = \"margin-top:-15px;position:absolute;z-index=2;background:silver;border:1px solid grey;border-collapse:collapse;width:380px;\" onkeypress = \"if (event.keyCode == 40)traverse();\" onblur = \"clod()\"><tr><td onkeydown = \"if(event.keyCode == 40) return false;\" style = \"padding:0px;background:white;width:100%;\">		<input autofocus style = \"border:2px solid green;width:100%;height:28px;font-size:15px;\" type=\"text\" list=\"listshow\" id=\"leds\" name=\"other_ledger\" onKeyUp=\"if(event.keyCode == 40) traverse('up'); else searchledger(this.value,".$sno.",'true');\" onKeydown=\"if(event.keyCode == 13) value_by_barcode(this.value);\"></td></tr><tbody id = \"ler\"></tbody></table>";

echo "<input type = 'text' list = 'exampleList' name = 'example' id = 'example_input' oninput = 'showdatalist_value()' style = 'width:100%;height:28px;' autofocus/>";
echo "<datalist id = 'exampleList' >";
$query_list_ledger = mysqli_query($con,"select * From ledgers where ledger_type = 1");
while($row_ledger = mysqli_fetch_array($query_list_ledger))
{
echo "<option value = '".$row_ledger['ledger_name']."' data-id = '".$row_ledger['ledger_id']."' id = '".$row_ledger['ledger_id']."'> L ".$row_ledger['ledger_id']."</option>";
}
//echo "<option value = 'Rama Books' data-id = '6' id = '6' onKeyUp = 'alert(\"6\");'>6</option>";
//echo "<option value = 'Aatma ram' data-id = '7' id = '7' onKeyUp = 'alert(\"7\");'>7</option>";
echo "</datalist>";
echo "</td><td></td>";
//echo "</td><td class = 'lisst' ><span>EMI Amount : </span></td><td><input name = 'emiAmount' id=\"emiAmount\" style = \"padding:5px;width:100%;font-size:15px;\" type = 'text' placeholder = 'Set installment'></td></tr>";
echo "<tr style = 'border-top-style:solid;border-color:grey;border-width:3px;border-bottom-style:solid;'><th colspan = '2' style = 'background:peachpuff;'>ITEM NAME</th><th style = 'background:peachpuff;'>QTY</th><th style = 'background:peachpuff;'>AMOUNT</th></tr>";

//autofill ends here for ledger


echo "<tr><td colspan = '2' >";

echo "<table id = \"sero\" tabindex = \"444\" style = \"margin-top:-15px;position:absolute;z-index=2;background:silver;border:1px solid grey;border-collapse:collapse;width:380px;\" onkeypress = \"if (event.keyCode == 40)traverse();\" onblur = \"clod()\"><tr><td onkeydown = \"if(event.keyCode == 40) return false;\" style = \"padding:0px;background:white;width:100%;\">		<input autofocus style = \"border:2px solid green;width:100%;height:28px;font-size:15px;\" placeholder = 'Item Name' type=\"text\" list=\"listshow\" id=\"ls\" name=\"item_uid\" onKeyUp=\"if(event.keyCode == 40) traverse('up'); else searchitem(this.value,".$sno.");\" onKeydown=\"if(event.keyCode == 13) value_by_barcode(this.value);\"></td></tr><tbody id = \"ser\"></tbody></table>";

echo "</td>";
//echo "<tr></tr>";
echo "<td style = 'text-align:right;width:120px;'><input name = 'qty' id=\"qty\" style = \"padding:5px;width:60px;font-size:15px;\" type = 'text' placeholder = 'quantity'></td>";
echo "<td><input name = 'amount' id=\"figure_amount\" style = \"padding:5px;width:100%;font-size:15px;\" type = 'text' placeholder = 'enter amount' onKeyUp = 'if(event.keyCode == 13)submit_backsales();'></td>";
//echo "<tr><td class = 'lisst'><span >By : </span></td><td><select name = 'other_ledger' id = \"mode_of_transfer\" style = \"padding:5px;width:100%;font-size:15px;\">";
//foreach($array_ledger  as $ledger)
//{
//	echo "<option value = ".$ledger['ledger_id'].">".$ledger['ledger_name']."</option>";
//}
//echo "</select></td></tr>";
// echo  "<tr><td></td><td>
echo "<td><input type= 'button' value = 'submit' id=\"searchbtn\" style = \"//display:inline;float:right;margin-top:1px;height:23px;\" onclick = \"submit_backsales()\"></td></tr>";
echo "</table>";
//echo "</form>";
//}
?>
<div id = "sale_output">
</div>

</div>
