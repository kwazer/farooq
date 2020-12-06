<?php
$bill_no = $_REQUEST["tran_id"]; 
//echo $bill_no;
?>
<script>
var g_sno = <?php echo $bill_no;?>;
</script>
<style>
	td,th
	{
		border-bottom-style:solid;
		border-width:1px;
		border-left-style:solid;
height:26px;

	}
	th
	{
		text-align:left;
		background:peachpuff;
	}
	table
	{
		//border-right-style:none;
	}
	.center_text
	{
		text-align:center;
		background:peachpuff;
	}
	#expense_table td,#item_table td,#gr_table td,#gr_qty td
	{
		border:none;
	}
</style>
<script>
//	var rate;
var freight;
	function confirm_freight(sno)
	{
		if(event.keyCode ==  13)
		{
		//	alert("it works");
		var rate = document.getElementById("fr_rate"+sno).value;
//alert(rate);
freight = rate;
		var peti = document.getElementById("p"+sno).innerHTML;
		var dabba = document.getElementById("d"+sno).innerHTML;
		var tot = (peti*rate) + ((dabba*rate)/2);
		//alert(tot);
		document.getElementById("tot_fr"+sno).innerHTML = tot;
	}
	}
var gl_advance;
	function confirm_advance(sno,advanc)
	{

		var rate = document.getElementById("fr_rate"+sno).value;
                var pet = document.getElementById("p"+sno).innerHTML;
                var dabb = document.getElementById("d"+sno).innerHTML;
//alert();
advanc = advanc *1;
gl_advance = advanc;
advanc =  (advanc * pet) + (advanc * (dabb/2));
//alert(advanc);
		if (rate != "")
		{
//			var advanc = document.getElementById("adv"+sno).innerHTML;
			//alert(advanc);
        
//advanc = advanc + (advanc * (dabb/2));
//alert(advanc);
			var tot_fr = document.getElementById("tot_fr"+sno).innerHTML;
			var balance = document.getElementById("balance"+sno).innerHTML = advanc - tot_fr;
			if(event.keyCode == 13)
			{
				var x = confirm("do you want to save the changes");
				if(x == true)
				{
					 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
        {
                        //document.getElementById("baardana_detail").innerHTML = xhr.responseText;
           //             alert(xhr.responseText);
var conf = confirm("do you want to update all");
if(conf == true)
{
//alert("confirmed");
//sno = sno *1;
update_all(sno);
}
        }
 }
 xhr.open("GET","update_challan_details.php?sno="+sno+"&rate="+rate+"&total_freight="+tot_fr+"&advance="+advanc+"&balance="+balance,true);
 xhr.send();
				}
			}
		}
	}

function update_all(ssno)
{
//alert(ssno+" "+freight+" "+gl_advance); 
                                         var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
        {
                        //document.getElementById("baardana_detail").innerHTML = xhr.responseText;
//                        alert(xhr.responseText);
location.reload();
        }
 }
 xhr.open("GET","update_all_challan_details.php?sno="+ssno+"&rate="+freight+"&advance="+gl_advance,true);
 xhr.send();
}
</script>
<?php
//$bill_no = $_REQUEST["tran_id"];
$con = mysqli_connect("localhost","root","password","farooq");
//echo $con;
echo "<div style = 'margin:0 auto;'>";
echo "<div style = 'margin:0 auto;width:650px;border:1px solid grey;'>";
echo "<table style = 'width:100%;border-collapse:collapse;' border ='0' id = 'main_table'>";
//if($bill_no != NULL)
//{
//echo $bill_no;
//$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from watak_detail where watak_no = '$bill_no'");

$query = mysqli_query($con,"select * from challan_detail where challan_id = $bill_id");
while($r = mysqli_fetch_array($query))
{
	//echo $r['sno'];
	$pname = $r['party_name '];
	$marka = $r['marka'];
	$challan = $r['challan_id'];
	$truck = $r['truck_no'];
	$date = $r['date'];
	$new_name = $r['party_name'];
//	$adv_to_driver = $r['adv_to_driver'];

}

$query_expenses = mysqli_query($con,"select * from watak_expenses where watak_no = '$bill_no'");
while($row = mysqli_fetch_array($query_expenses))
{
	if($row['expense_head'] == 'freight')
	$freight = $row['amount'];
	if($row['expense_head'] == 'commission')
	$commission = $row['amount'];
	if($row['expense_head'] == 'Labour')
	$labour = $row['amount'];
	if($row['expense_head'] == 'postage')
	$postage = $row['amount'];
	if($row['expense_head'] == 'association')
	$ass = $row['amount'];
	if($row['expense_head'] == 'trading Expenses')
	$v_exp= $row['amount'];
	$tot_exp = $row['amount'] + $tot_exp;
}
$query_daybook = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from daybook join ledgers using (ledger_id) join truck_details on truck_details.challan_no = daybook.transaction_id where transaction_type = 11 and transaction_id= $bill_no");
while($r = mysqli_fetch_array($query_daybook))
{
	$date = $r['date'];
	$p_name = $r['ledger_name'];
$truck_no = $r['truck_no'];
$driver_name = $r['driver_name'];
$ph = $r['phone_no'];
        $adv_to_driver = $r['adv_to_driver'];

//	echo $r['ledger_name'];
}
//}
//$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from daybook join sale_ledgers using(sno) where transaction_type = 2 and transaction_id = $bill_no");
//else
//$query = mysqli_query($con,"select *,DATE_FORMAT(date,'%d-%m-%Y') as date from daybook join sale_ledgers using(sno) where transaction_type = 2 order by transaction_id desc limit 1");
//while($row = mysqli_fetch_array($query))
//{
//	$ledger_name = $row['ledger_name'];
//	$amount = $row['amount'];
//	$date = $row['date'];
//	$bill_no = $row['transaction_id'];
//	$address = $row['address'];
//	$phone_no = $row['phone_no'];
//}
echo "<tr style = 'text-align:center;'><td colspan = '9' style = 'border:1px solid black;text-align:center;width:100%;color:black;'><span  style = 'float:right;color:black;font-weight:normal;font-size:12px;'><h4>T : 01951-254400<br>C: 919797274400<br>C: 919419434400<br>C: 919018184400</h4></span><h2 ><span style = 'font-family:Copperplate,Copperplate Gothic Light,fantasy;letter-spacing:1px;font-size:25px;' onclick = 'location.href=\"transactions.php\"'>FAROOQ FRUIT CO.</span><br> <span style = 'font-size:15px;color:black;font-weight:normal;'><span style = 'color:black;padding:1px 4px;font-weight:bold;font-style:italic;border-radius:5px;'>Fruit Grower Commission & Forwarding Agents </span><br>55 / 56 Fruit & Vegetable Market<br>Zaloosa Charari-Sharief, Kashmir - 191112</span></h2></td></tr>";
echo "<tr><td colspan = '9' style = 'text-align:center;letter-spacing:1px;font-weight:bold;font-size:19px;'>Challan # $bill_no</td></tr>";
/*
echo "<tr><td colspan = '6'>Watak / Sale # <span style = 'color:navy;font-weight:bold;'>$bill_no</span></td><td colspan = '1'>Challan # <span style = 'color:navy;font-weight:bold;'>$challan</span></td></tr>";
echo "<tr><td colspan = '6'>Name : <span style = 'color:navy;font-weight:bold;'>".$p_name."</span></td><td colspan = '1'>Truck # <span style = 'color:navy;text-transform:uppercase;font-weight:bold;'>$truck</span></td></tr>";
echo "<tr><td colspan = '6'>Marka : <span style = 'color:navy;font-weight:bold;'>".$marka."</span></td><td colspan = '1'>Receipt # </td></tr>";
*/
echo "<tr><td colspan = '9'><span style = 'float:right;'>";
echo "<table style = 'border-collapse:collapse;border:0px whitel;' border = '0'>";
echo "<tr><td>Truck no:</td><td>$truck_no</td></tr>";
echo "<tr><td>Driver name</td><td>$driver_name</td></tr>";
echo "<tr><td>Phone</td><td>$ph</td></tr>";
echo "</table>";
echo "</span>";
echo "Date : <span style = 'color:black;font-weight:bold;'>".$date."</span><br>";
echo "<span style = 'color:black;font-weight:bold;'></span><br><span style = 'font-weight:bold;font-size:18px;letter-spacing:1px;'>M/s</span> : <span style = 'color:black;font-weight:bold;text-transform:capitalize;font-size:18px;'>".$p_name."</span>";

echo "</td></tr>";




echo "<tr style = 'font-weight:bold;'><td class = 'center_text' style = 'width:100px;'>Khata</td><td class = 'center_text' style = 'text-align:center;width:30px;'>P</td><td class = 'center_text' style = 'width:30px;'>H</td><td class = 'center_text' style = 'font-size:15px;'>Kind</td><td class = 'center_text' style = 'width:30px;'>Freight<br>/Peti</td><td class = 'center_text' style = 'text-align:center;width:60px;'>Total Fr.</td><td class = 'center_text' style = 'width:50px'>Advance</td><td class = 'center_text'>Balance</td><td class = 'center_text'>Amount to <br> Credited.</td></tr>";

//echo "<tr><td colspan = 9 style ='height:300px;vertical-align:top;'>";
//echo "<table style = 'width:100%;font-size:13px;' border = '1' id = 'item_table'>";
$query = mysqli_query($con,"select * from challan_detail where challan_id = '".$bill_no."'");
$sum = 0;
$count = 1;
while($row_item = mysqli_fetch_array($query))
{
	$gr_tot_fr = $gr_tot_fr +$row_item['total_freight'];
	$gr_tot_ad = $gr_tot_ad +$row_item['advance'];
//        $gr_tot_ad = $gr_tot_ad +$adv_to_driver;

	//echo $row['peti'];
	echo "<tr style = 'font-size:14px;'><td style = 'font-size:16px;font-weight:bold;text-align:left;'>".$row_item["marka"]."</td><td style = 'text-align:center;' id = 'p".$row_item['sno']."'>".$row_item["peti"]."</td><td style = 'text-align:center;' id = 'd".$row_item['sno']."'>".$row_item['dabba']."</td><td style = 'text-align:left;font-size:12px;'>".$row_item['kind']."</td><td style = 'text-align:center;margin-left:5px;font-size:12px;width:30px;'><input type = 'text' onkeypress = 'confirm_freight(".$row_item['sno'].")' value = '".$row_item['fr_rate']."'  id = 'fr_rate".$row_item['sno']."' style = 'width:100%;border:0px;text-align:center;'/></td><td style = 'text-align:right;'  id = 'tot_fr".$row_item['sno']."'>".$row_item['total_freight']."</td><td style = 'text-align:right;'><input type = 'text'  id='adv".$row_item['sno']."' onkeyup = 'confirm_advance(".$row_item['sno'].",this.value)' value = '".($row_item['advance']/($row_item['peti']+($row_item['dabba']/2)))."' style = 'text-align:center;border:0px;width:50px;'/></td><td style = 'text-align:right;' id = 'balance".$row_item['sno']."' >".$row_item['balance']."</td><td style = 'text-align:right;'></td>";
	echo "</tr>";
	$tot_peti = $tot_peti + $row_item['peti'];
	$tot_dabba = $tot_dabba + $row_item['dabba'];
	$tot_amount = $tot_amount + $row_item['amount'];
$count = $count + 1;
}
?>
<script>
function adv_to_driver(adva)
{
//alert(g_sno);
                                         var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
        {
                        //document.getElementById("baardana_detail").innerHTML = xhr.responseText;
//                        alert(xhr.responseText);
alert(adva+" "+g_sno);
        }
 }
 xhr.open("GET","update_advance.php?advance="+adva+"&tran_id="+g_sno,true);
 xhr.send();
}
</script>
<?php
$loop_limit = 20-$count;
for($x=1;$x<$loop_limit;$x++)
{
echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
}
echo "<tr><td colspan = '3'>ADVANCE CASH TO DRIVER =</td><td id = 'adv_to' colspan = '6'><input id = 'adv_to_driver' value = '".$adv_to_driver."' type = 'text' onkeyup = 'if (event.keyCode == 13)adv_to_driver(this.value)' style = 'font-weight:bold;font-size:18px;width:100%;border:0px;text-align:center;padding-right:20px;'/></td></tr>";
$gr_tot_ad = $gr_tot_ad + $adv_to_driver;
//echo "</table>";
//echo "</td>";

//echo "<td style = 'vertical-align:top;'>";
//	echo "<table id = 'expense_table' cell-spacing = '0' cell-padding = '0' border = \"0\" style = 'font-size:13px;border-collapse:collapse;border:none;width:100%;'><tr><td>Freight:</td><td style = 'text-align:right;'> $freight</td></tr><tr><td>Comxn: </td><td style = 'text-align:right;'>$commission</></td></tr><tr><td>Labour</td><td style = 'text-align:right;'> $labour</td></tr><tr><td>Postage</td><td style = 'text-align:right;'> $postage</td></tr><tr><td>Assoc.</td><td style = 'text-align:right;'> $ass</td></tr><tr><td>V. Exp</td><td style = 'text-align:right;'> $v_exp</td></tr></table>";

//echo "</td>";

echo "</tr>";
echo "<tr style = 'font-weight:bold;color:black;'><td></td><td style = 'text-align:right;'>$tot_peti</td><td style = 'text-align:right;'>$tot_dabba</td><td colspan = '3' style = 'text-align:center;'>Total</td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_amount)."</td></tr>";
echo "<tr><td colspan = '9'>";

echo "<table style = 'width:100%;' id = 'gr_qty'>";
echo "<tr><td>Total Peti : $tot_peti<br>Total Half : $tot_dabba</td><td>";
echo "<table style = 'width:100%;border:1px solid grey;' id = 'gr_table'>";
echo "<tr><td style = 'font-weight:bold;color:black;letter-spacing:1px;font-size:18px;'>Total Advance Amount = </td><td style='text-align:right;font-weight:bold;color:black;letter-spacing:1px;font-size:18px;'>".sprintf("%.2f",$gr_tot_ad)."</td></tr>";
//echo "<tr><td>Gr Total</td><td style = 'text-align:right;'>".sprintf("%.2f",$tot_amount)."</td></tr>";
echo "</table>";
echo "</td></tr>";
echo "</table>";

echo "</td></tr>";
//$net_amount = $tot_amount - $tot_exp;
$net_amount = $gr_tot_fr-$gr_tot_ad;
echo "<tr><td colspan = '9' style = 'text-align:center;font-weight:bold;color:black;font-size:18px;letter-spacing:1px;'>Amount payable to driver =  ".sprintf("%.2f",$net_amount)."</td></tr>";

echo "</table>";
echo "</div>";
//echo  "<p style = 'text-align:center;font-weight:bold;font-size:20px;'>We appreciate your Hurry but Hurry takes Time</p>";
echo "<table style = 'width:650px;border-collapse:collapse;margin:0 auto;' border ='0' id = 'border_footing'>";
echo "<tr><td style = 'border:none;'colspan = '' style = 'text-align:left;'><span style = 'font-size:13px;'>Goods have been properly loaded in good condition <br>Any damamge, less or late delivery of goods will be the total responsibility of the transporter<br> E & O.E</span>";
echo "<br><span style = 'float:right;'>For FAROOQ FRUIT CO..</span></td></tr>";
echo "</table>";

//echo "<tr><td style = 'border:none;'colspan = '' style =  'text-align:center;font-weight:bold;padding:10px;letter-spacing:1px;color:brown;'>Good sale and Prompt service is our motto</td></tr>";
echo "<h3 style = 'margin: 0 auto;width:450;text-align:center;;color:black;'>Good Sale and Prompt Service is our motto</h3>";
echo "</div>";
?>
