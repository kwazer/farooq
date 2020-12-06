<?php 
session_start();
include 'con.php';
$sno = 15;
$ledger_type = "fruit_sale";
$query_clear = mysqli_query($con,"delete from fruit_buffer");
$query_se = mysqli_query($con,"select * From daybook where transaction_type = '$sno' order by transaction_id desc limit 1");
while($row_se = mysqli_fetch_array($query_se))
{
	
	$bil_no = $row_se['transaction_id'];
	$date_fill = $row_se['date'];
}
	if(isset($bil_no))
	$bil_no = $bil_no + 1;
	else
	$bil_no = 1;
?>
<div id = "main-window" style = "width:780px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
$array_ledger = array();

$query_ledger = mysqli_query($con,"select * from ledgers where ledger_type between 3 and 4");
while($row_ledger = mysqli_fetch_array($query_ledger))
{
	$array_ledger[] = $row_ledger;
}
//print_r($array_ledger);
echo "<form action = \"back".$ledger_type.".php\" method = \"post\">";
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='transactions.php';\">Back</span><br><hr>";
echo "<input type = 'text' name = 'transaction_type' id = 'transaction_type' value = '".$sno."' style = 'display:none;'/>";
echo "<input type = 'text' name = 'bill_no' id = 'serial_no' value = '".$bil_no."' style = 'display:none;' />";
echo "<input type = 'text' name = 'ledger_id' id = 'uid' style = 'display:none;'/>";
echo "<table border = \"0\" style = \"border-collapse:collapse;width:100%;\">";
echo "<tr><td style = 'text-transform:capitalize;color:brown;' class = 'lisst'>".$ledger_type." #".$bil_no."</td></tr>";
echo "<tr><td class = 'lisst'><span>Date : </span></td><td><input type = 'date' placeholder = 'DD-MM-YYYY' style = 'width:100%;font-size:15px;padding:5px;height:28px;' name = 'date' id = 'date' value = '$date_fill' autofocus/></td></tr>";
echo "<tr><td class = 'lisst' '><span>Party Name : </span></td><td><span>";

echo "<input type = 'text' list = 'exampleList' name = 'example' id = 'example_input' autocomplete = 'off' oninput = 'showdatalist_value(".$sno.")' style = 'width:88%;height:28px;border:2px solid green;' autofocus/>";
echo "<datalist id = 'exampleList' >";
$query_list_ledger = mysqli_query($con,"select *,concat(ledger_tenure,ledger_id) as account_no From ledgers join ledger_details using (ledger_id) where ledger_type = 8");
while($row_ledger = mysqli_fetch_array($query_list_ledger))
{
echo "<option style = 'font-weight:heavy;' value = '".$row_ledger['ledger_name']." S/o ".$row_ledger['father_name']." R/O ".$row_ledger['address']."' data-id = '".$row_ledger['account_no']."' id = '".$row_ledger['account_no']."'><span style = 'font-size:18px;'>".$row_ledger['account_no']."</span></option>";
}
//echo "<option value = 'Rama Books' data-id = '6' id = '6' onKeyUp = 'alert(\"6\");'>6</option>";
//echo "<option value = 'Aatma ram' data-id = '7' id = '7' onKeyUp = 'alert(\"7\");'>7</option>";
echo "</datalist>";
echo "<datalist id = 'eList' >";
$query_list_ledger = mysqli_query($con,"select *,concat(ledger_tenure,ledger_id) as account_no From ledgers join ledger_details using (ledger_id) where ledger_type = 6");
while($row_ledger = mysqli_fetch_array($query_list_ledger))
{
echo "<option style = 'font-weight:heavy;' value = '".$row_ledger['ledger_name']." S/o ".$row_ledger['father_name']." R/O ".$row_ledger['address']."' data-id = '".$row_ledger['account_no']."' id = '".$row_ledger['ledger_id']."'><span style = 'font-size:18px;'>".$row_ledger['account_no']."</span></option>";
}
//echo "<option value = 'Rama Books' data-id = '6' id = '6' onKeyUp = 'alert(\"6\");'>6</option>";
//echo "<option value = 'Aatma ram' data-id = '7' id = '7' onKeyUp = 'alert(\"7\");'>7</option>";
echo "</datalist></span>";
echo "<span><input type = 'text' disabled style = 'width:12%;height:28px;color:red;' id = 'account_no'/></span>";


/*
echo "<table id = \"sero\" tabindex = \"444\" style = \"margin-top:-15px;position:absolute;z-index=2;background:silver;border:1px solid grey;border-collapse:collapse;width:380px;\" onkeypress = \"if (event.keyCode == 40)traverse();\" onblur = \"clod()\"><tr><td onkeydown = \"if(event.keyCode == 40) return false;\" style = \"padding:0px;background:white;width:100%;\">		<input autofocus style = \"border:2px solid green;width:100%;height:28px;font-size:15px;\" type=\"text\" list=\"listshow\" id=\"ls\" name=\"ledger_name\" onKeyUp=\"if(event.keyCode == 40) traverse('up');else searchitem(this.value,".$sno.");\"></td></tr><tbody id = \"ser\"></tbody></table>";
*/

echo "</td></tr>";
 echo  "<tr><td></td><td><input type= 'submit' id=\"searchbtn\" style = \"//display:inline;float:right;margin-top:1px;height:23px;\"></td></tr>";
echo "</table>";
echo "</form>";
echo "<table style = 'width:100%;'>";
echo "<input type = 'text' style = 'display:none;' id = 's_ledger_id'/>";
echo "<th>Khata</th><th>Peti</th><th>Half</th><th>Kind</th><th>Variety</th><th>Rate</th><th>Amount</th>";
//echo "<tr><td><input list = '' type = 'text' id = 'sfruit_input' oninput = 'fill_s_ledger_id()'/></td><td><input id = 'peti' oninput = 'lock_other(\"dabba\")' type = 'text' style = 'width:35px;'/></td><td><input onkeydown = 'lock_other(\"peti\")' id = 'dabba' type = 'text' style = 'width:35px;'/></td><td><input id = 'variety' type = 'text' style = 'width:100px;'/><td><input id = 'quality' type = 'text' /></td><td><input id = 'rate' type = 'text'  style = 'width:50px;' onkeyup = 'add_details($bil_no)'/></td><td><input id = 'amount' type = 'text'  style = 'width:70px;' disabled/></td></tr>";
echo "<tr><td><input list = '' type = 'text' id = 'sfruit_input'/></td><td><input id = 'peti' oninput = 'lock_other(\"dabba\")' type = 'text' style = 'width:35px;'/></td><td><input onkeydown = 'lock_other(\"peti\")' id = 'dabba' type = 'text' style = 'width:35px;'/></td><td><input id = 'variety' type = 'text' style = 'width:100px;'/><td><input id = 'quality' type = 'text' /></td><td><input id = 'rate' type = 'text'  style = 'width:50px;' onkeyup = 'add_details($bil_no)'/></td><td><input id = 'amount' type = 'text'  style = 'width:70px;' disabled/></td></tr>";
echo "</table>";
?>
<div id = 'display-pod'>
	
</div>
</div>
