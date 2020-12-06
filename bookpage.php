<html>
	<body>
		<div style = "width:750px;margin:0 auto;"> 
			<style>
				.oper
				{
					color:olive;
				}
				td
				{
					vertical-align:center;
					text-align:center;
					font-size:15px;
					padding:5px;
				}
				th
				{
					font-weight:normal;
					color:brown;
				}
				
				a 
				{
					text-decoration:none;
					color:inherit;
				}
				.item_list:hover
				{
					color:red;
				}
				

			</style>
<?php 
$runner_id = $_GET["cat_id"];
$book_id = $_GET["item_id"];
$alpha_serial = $_REQUEST["alpha_serial"];
$book_begin = $_REQUEST["book_begin"];
$book_end = $_REQUEST["book_end"];
$arrayBooks = Array();
for($i=$book_begin;$i<=$book_end;$i++)
{
	$arrayBooks[$i] = $i; 
}
//print_r($arrayBooks);
;//echo $book_begin;
//echo $book_end;


echo "<div style = \"background:white;padding:10px;text-transform:capitalize;border:0px solid black;width:730px;border-radius:10px 10px 0px 0px;\"><big style = \"font-size:28px;color:grey;letter-spacing:2px;\">".$cat_name."</big>";
echo "<span style = 'float:right;'><a href= 'bookpage.php?cat_id=$unner_id&item_id=$book_id&alpha_serial=$alpha_serial&book_begin=$book_begin&book_end=$book_end'><button>Print</button></a><a href='emi_setting.php'><button>Back</button></a></span>";
//echo "<a style = \"text-decoration:none;color:brown;\" href = \"additem.php?cat_id=".$cat_id."&cat_name=".$cat_name."\"><span style = \"margin-left:10px;border:0px solid black;padding:3px;\">Add Item</span></a><hr></div>";
//echo "<a style = \"text-decoration:none;color:brown;\" onclick = \"add_item(".$cat_id.",'".$cat_name."')\"><span style = \"margin-left:10px;border:0px solid black;padding:3px;cursor:pointer;\">Issue Receipt Book</span></a><hr></div>";
include 'con.php';
$cumSum = 0;
//$con = mysqli_connect("localhost","root","password","shop");
//$query = mysqli_query($con,"select * from receipt_detail join book_issue using (runner_id) join receipt_books using (book_id) join ledgers using (ledger_id) where receipt_no between serial_begin and serial_end and book_id = '$book_id' ");
$query = mysqli_query($con,"select cancel_flag,sno,date,receipt_no,alpha_serial,ledger_name,amount from receipt_detail join ledgers using(ledger_id) where book_id = '$book_id' ");
echo "<table border = \"0\" style = \"border-collapse:collapse;width:100%;background:ivory;padding:5px;border-radius:0px 0px 10px 10px;\">";
echo "<th>Receipt No</th><th>date</th><th>ledger</th><th>amount</th><th>Cum Sum</th>";
while($row = mysqli_fetch_array($query))
{
/*	echo "<tr><td><a style = \"text-decoration:none;\" href=\"edititem.php?item_id=".$row['item_id']."&cat_name=".$cat_name."&cat_id=".$cat_id."\">".$row['item_name']."</a></td><td>".$row['item_qty']."</td><td>".$row['sale_price']." ".$row['unit']."</td><td>".$row['item_price']." per/pc</td><td>".$row['position']."</td><td class = \"oper\" ><a href=\"in.php?item_id=".$row['item_id']."&item_name=".$row['item_name']."&cat_name=".$cat_name."&cat_id=".$cat_id."\"> IN</a></td><td class = \"oper\"><a href = \"out.php?item_id=".$row['item_id']."&item_name=".$row['item_name']."&cat_name=".$cat_name."&cat_id=".$cat_id."\">OUT</a></td></tr>";
	$sum = $sum + $row['item_qty'];
*/
/*
$cumSum = $cumSum + $row['amount'];
	echo "<tr><td class = \"item_list\" ><a  style = \"text-decoration:none;cursor:pointer;color:grey;\" onclick = \"show_itempage('".$cat_name."',$cat_id,".$row['book_no'].")\">".$row['alpha_serial'].$row['receipt_no']."</a></td><td>".$row['date']."</td><td>".$row['ledger_name']."</td><td>".$row['amount']."</td><td> ".$cumSum."</td>";
	//echo "<td class = \"oper\" ><a href=\"in.php?item_id=".$row['item_id']."&item_name=".$row['item_name']."&cat_name=".$cat_name."&cat_id=".$cat_id."\"> IN</a></td><td class = \"oper\"><a href = \"out.php?item_id=".$row['item_id']."&item_name=".$row['item_name']."&cat_name=".$cat_name."&cat_id=".$cat_id."\">OUT</a></td>";
	echo "</tr>";
	*/
//	$sum = $sum + $row['item_qty'];
$arrayDatabase[] = $row;
$receipt_no = $row['receipt_no'];
$arrayBooks[$receipt_no] = array($row['date'],$row['ledger_name'],$row['amount'],$row['sno'],$row['cancel_flag']);
/*
 $arrayBooks[$receipt_no][date] = $row['date'];
$arrayBooks[$receipt_no][ledger_name] = $row['ledger_name'];
$arrayBooks[$receipt_no][amount] = $row['amount'];
*/
}
//print_r($arrayBooks);
//print_r($arrayDatabase);
//foreach($arrayBooks as $ro)
for($i=$book_begin;$i<=$book_end;$i++)
{
	
$cumSum = $cumSum + $arrayBooks[$i][2];
if($arrayBooks[$i][0] == "")
{
if($arrayBooks[$i][4] == 0)
{
	echo "<tr><td class = \"item_list\" ><a  style = \"text-decoration:none;cursor:pointer;color:grey;\" >".$alpha_serial.$i."</a></td><td>";
	echo $arrayBooks[$i][0]."</td><td>".$arrayBooks[$i][1]."</td><td>".$arrayBooks[$i][2]."</td><td> ".$cumSum."</td><td><button onclick = 'cancel_receipt(\"".$alpha_serial."\",".$i.")'>Cancel</button></td>";
	echo "</tr>";
}
else
{
	echo "<tr><td class = \"item_list\" ><a  style = \"text-decoration:none;cursor:pointer;color:grey;\" >".$alpha_serial.$i."</a></td><td>";
	echo $arrayBooks[$i][0]."</td><td>".$arrayBooks[$i][1]."</td><td>".$arrayBooks[$i][2]."</td><td> ".$cumSum."</td><td><button onclick = 'cancel_receipt(\"".$alpha_serial."\",".$i.")'>Cancel</button></td>";
	echo "</tr>";
}
	}
else
{
	echo "<tr><td class = \"item_list\" ><a  style = \"text-decoration:none;cursor:pointer;color:grey;\" >".$alpha_serial.$i."</a></td><td>";
	echo $arrayBooks[$i][0]."</td><td>".$arrayBooks[$i][1]."</td><td>".$arrayBooks[$i][2]."</td><td> ".$cumSum."</td>";
	echo "</tr>";
}
}
echo "</table>";

?>
</div>
</body>
</html>
