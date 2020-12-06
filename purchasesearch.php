<?php
session_start();
include 'con.php';
$sno = $_REQUEST["type_id"];
$ledger_type = $_REQUEST["type_name"];

//$query_se = mysqli_query($con,"select * From daybook where transaction_type = '$sno' order by transaction_id desc limit 1");
//while($row_se = mysqli_fetch_array($query_se))
//{
	
//	$bil_no = $row_se['transaction_id'];
//}
//	if(isset($bil_no))
//	$bil_no = $bil_no + 1;
//	else
//	$bil_no = 1;

?>
<style>
	.lisst
	{
		color:navy;
		text-align:left;
	}
	
</style>
<script>

//function del()
//{
//	location.href = 'deleteitem.php?item_id='+item_id;
//}

</script>
<div id = "main-window" style = "width:820px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
$query_date = mysqli_query($con,"select DATE_FORMAT(date,'%d-%m-%Y') as date,alpha_serial from receipt_detail order by sno desc limit 1");
while($rowDate = mysqli_fetch_array($query_date))
{
	$date_fill = $rowDate['date'];
	$alpha_serial = $rowDate['alpha_serial'];
}
$array_ledger = array();

$query_ledger = mysqli_query($con,"select * from ledgers where ledger_type between 3 and 4");
while($row_ledger = mysqli_fetch_array($query_ledger))
{
	$array_ledger[] = $row_ledger;
}
//print_r($array_ledger);
echo "<form action = \"back".$ledger_type.".php\" method = \"post\" onsubmit = \"return submit_item(this)\">";
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='searchpage.php';\">Back</span><br><hr>";
//echo "<input type = 'text' name = 'transaction_type' id = 'transaction_type' value = '".$sno."' style = 'display:none;'/>";
//echo "<input type = 'text' name = 'bill_no' id = 'serial_no' value = '".$bil_no."' style = 'display:none;' />";
//echo "<input type = 'text' name = 'ledger_id' id = 'uid' style = 'display:none;'/>";
echo "<table border = \"0\" style = \"border-collapse:collapse;width:100%;\">";
//echo "<tr><td style = 'text-transform:capitalize;color:brown;' class = 'lisst'>".$ledger_type." #".$bil_no."</td></tr>";
//echo "<tr><td class = 'lisst'><span>Date : </span></td><td><input type = 'text' placeholder = 'DD-MM-YYYY' style = 'width:100%;font-size:15px;padding:5px;height:28px;' name = 'date' value = '$date_fill'/></td></tr>";
//echo "<tr><td class = 'lisst' '><span>Party Name : </span></td><td>";

//echo "<table id = \"sero\" tabindex = \"444\" style = \"margin-top:-15px;position:absolute;z-index=2;background:silver;border:1px solid grey;border-collapse:collapse;width:380px;\" onkeypress = \"if (event.keyCode == 40)traverse();\" onblur = \"clod()\"><tr><td onkeydown = \"if(event.keyCode == 40) return false;\" style = \"padding:0px;background:white;width:100%;\">		<input autofocus style = \"border:2px solid green;width:100%;height:28px;font-size:15px;\" type=\"text\" list=\"listshow\" id=\"ls\" name=\"ledger_name\" onKeyUp=\"if(event.keyCode == 40) traverse('up');else searchitem(this.value,".$sno.");\"></td></tr><tbody id = \"ser\"></tbody></table>";

//echo "</td></tr>";
echo "<tr><td class = 'lisst'><span >Purchase No :</span></td><td><input style = 'width:65%;height:28px;' type = 'text' name = 'example'/></td></tr>";
//echo "<tr><td class = 'lisst' ><span>Amount : </span></td><td><input name = 'amount' id=\"figure_amount\" style = \"padding:5px;width:100%;font-size:15px;\" type = 'text' placeholder = 'enter amount'></td></tr>";
//echo "<tr><td class = 'lisst'><span >By : </span></td><td><select name = 'other_ledger' id = \"mode_of_transfer\" style = \"padding:5px;width:100%;font-size:15px;\">";
//foreach($array_ledger  as $ledger)
//{
//	echo "<option value = ".$ledger['ledger_id'].">".$ledger['ledger_name']."</option>";
//}
//echo "</select></td></tr>";
 echo  "<tr><td></td><td><input type= 'submit' id=\"searchbtn\" style = \"//display:inline;float:right;margin-top:1px;height:23px;\"></td></tr>";
echo "</table>";
echo "</form>";
?>
<div id = 'search_result'>

</div>
</div>
