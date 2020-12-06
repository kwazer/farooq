<?php
session_start();
$date_search = $_REQUEST["date"];
$enddate = $_REQUEST["enddate"];

//$date_search = date_format($date_search,"Y/m/d");
//$enddate = date_format($enddate,"Y/m/d");
$date_flag = $_REQUEST["flag_date"];
if(!$_SESSION["username"])
{
	header("location:index.html");
} 
include 'con.php';
$array_runner = array();
$query_runner = mysqli_query($con,"select * from runner");
while($row_runner = mysqli_fetch_array($query_runner))
{
	$runner_id = $row_runner['runner_id'];
	$array_runner[$runner_id] = $row_runner['runner_name'];
}

?>
<html>
	<script>
		var previous_row_no;
	function insert_details(row_number,sno,type_id)
	{
		var view_table = document.getElementById("view_table");
		
//		alert(row_number);
//alert(type_id);	
		if(table_index.includes(row_number))
		{
			var locationIndex = table_index.indexOf(row_number);
			table_index.splice(locationIndex,1);
			row_number = row_number + 1;
			view_table.deleteRow(row_number);
					for(var i=0,len=table_index.length;i<len;i++)
		{
			if(table_index[i] > row_number)
			{
				table_index[i] = table_index[i] - 1;
			}
		}

		}
		else
	{

//		table_index[] = row_number;
table_index.push(row_number);
//		if(previous_row_no != "")
//		{
//			var deleter_row = previous_row_no + 1;
			
//			view_table.deleteRow(deleter_row);
//		}
//		alert(view_table.rows[row_number].innerHTML);
if(type_id != 4 && type_id != 5 && type_id != 6)
{
	var target = view_table.rows[row_number];
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{

	if(xhr.readyState == 4 && xhr.status == 200)
	{
		var new_element = document.createElement("tr");
		//new_element.style.display = "block";
		var new_column = document.createElement("td");
		new_column.innerHTML = xhr.responseText;
//		if(g_type_id == 1)
		new_column.colSpan = "7";
//		else
//		new_column.colSpan = "4";
		new_element.appendChild(new_column);
		previous_row_no = row_number;
		target.parentNode.insertBefore(new_element, target.nextSibling);
	}
	}
	xhr.open("GET","view_details.php?sno="+sno+"&type_id="+type_id,true);
	xhr.send();
		
		for(var i=0,len=table_index.length;i<len;i++)
		{
			if(table_index[i] > row_number)
			{
				table_index[i] = table_index[i] + 1;
			}
		}
}
}
//else
//{
//	alert("in array already");
//}		

	}
	</script>
	<style>
		big
		{
			letter-spacing:1px;
		}
		th
		{
			font-weight:normal;
			color:brown;
		}
		td
		{
			text-align:center;
			padding:5px;
			color:grey;
		}
		html
		{
			margin:0;
		}
		body
		{
			margin:0;
		}
		div
		{
			margin:0;
		}
		#main
		{
			border:1px solid grey;
			margin:0 auto;
			max-width:1000px;
			min-height:500px;
			padding:2px;
			position:relative;
//			overflow:auto;
			background:url("pic.png") center repeat;
		}
		#logo
		{
			margin:0px;
			padding-top:10px;
			padding-bottom:2px;
			font-size:25px;
			letter-spacing:12px;
			width:100%;
			text-align:center;
			border-bottom-style:solid;
			border-color:white;
			border-width:2px;
			color:black;
//			background:white;
		}
		.inf
		{
			border:1px solid grey;
		}
		#content
		{
			background:white;
//			background:url("backlogo.jpg") center no-repeat;
//			opacity:.5;
		}
		.day-options
		{
//			background:silver;
			display:block;
//			text-align:center;
		}
		
	</style>

	<head>
		<title>
			Vintage Voyages
		</title>
	</head>
	<body style="padding:2px;">
		<div id = "main">
			<p id = "logo" >FAROOQ ELECTRONICS</p>
			<br>
			<?php
			include 'menubar2.php'; 
			include 'con.php';
			?>
			
			<div style = "padding:10px;width:94%;min-height:498px;margin:5px auto;border:5px solid grey;border-radius:10px;" id = "content">
			<big style = "opacity:1;font-size:22px;display:block;letter-spacing:4px;color:grey;border-bottom-style:solid;border-width:1px;border-color:grey;padding-top:3px;text-align:center;">Sale Page</big>
			
			<Div style = "display:table;">
				<div style = "display:table-row;">
					<div style = "display:table-cell;width:1000px;">
<?php 
if(isset($date_search))
echo "<big style = 'text-align:left;display:block;color:blue;'><p style = 'text-align:center;'>Sale Page $date_search </p><span style = ''><a style = 'text-decoration:none;padding:3px;border:1px solid brown;color:brown;font-size:13px;border-radius:5px;margin:5px;' href=\"salepage.php?date=".$date_search."&flag_date=1\">By Bill Date</a><a style = 'text-decoration:color:brown;none;padding:3px;border:1px solid brown;font-size:13px;border-radius:5px;margin:5px;' href=\"salepage.php?date=".$date_search."&flag_date=0\">By Day</a></span><form action='salepage.php' method='GET' style = 'float:right;'><span style = 'font-size:14px;color:brown;padding:8px;'>Enter Date</span><input  type = 'date' placeholder = 'enter date' name = 'date'/><input  type = 'date' placeholder = 'enter date' name = 'enddate' style = 'margin-left:10px;'/><input type = 'submit'/></form></big><br>";else
echo "<big style = 'text-align:left;display:block;color:blue;'><p style = 'text-align:center;'>Sale Page Today </p><span style = ''><a style = 'text-decoration:none;padding:2px;border:1px solid brown;color:brown;font-size:13px;border-radius:5px;margin:5px;' href=\"salepage.php?flag_date=1\">By Bill Date</a><a style = 'text-decoration:none;color:brown;padding:2px;border:1px solid brown;font-size:13px;border-radius:5px;margin:5px;' href=\"salepage.php?flag_date=0\">By Day</a></span><form action='salepage.php' method='GET' style = 'float:right;'><span style = 'font-size:14px;color:brown;padding:8px;'>Enter Date</span><input  type = 'date' placeholder = 'enter date' name = 'date'/><input  type = 'date' placeholder = 'enter date' name = 'enddate' style = 'margin-left:10px;'/><input type = 'submit'/></form></big><br>";
?>
				<table style = "width:100%;border-radius:20px 0px 0px 20px;padding:5px;">
					<thead style = "background:peachpuff;color:grey;border-bottom-style:solid;border-color:black;border-width:1px;"><th style = 'padding:10px;'>Date</th><th style = 'width:350px;'>Party Name</th><th>Transaction Type</th><th>Serial #</th><th>Amount</th></thead>
<!--					<tbody>-->
				<?php 
				if(isset($date_search))
				{
//					if($date_flag == 1)
				$query_show_daybook = mysqli_query($con,"select *,date(lastupdated) as lastdate,DATE_FORMAT(date,'%d-%m-%Y') as date from daybook left join sale_ledgers using (ledger_id)join transaction_type on transaction_type.type_id = daybook.transaction_type where date between '$date_search' and '$enddate' and transaction_type = 2");
//else
//				$query_show_daybook = mysqli_query($con,"select *,date(update_time) as lastdate,DATE_FORMAT(date,'%d-%m-%Y') as date from daybook left join ledgers using (ledger_id)join transaction_type on transaction_type.type_id = daybook.transaction_type left join updatelog using (sno) where log_date = str_to_date('$date_search','%Y-%m-%d') or date(lastupdated) = str_to_date('$date_search','%Y-%m-%d') ");
			}
				else
				{
//					if($date_flag == 1)
				$query_show_daybook = mysqli_query($con,"select *,date(lastupdated) as lastdate,DATE_FORMAT(date,'%d-%m-%Y') as date from daybook left join sale_ledgers using (ledger_id) join transaction_type on transaction_type.type_id = daybook.transaction_type where date = 'CURDATE()' and transaction_type = 2");
//				else
//				$query_show_daybook = mysqli_query($con,"select *,date(update_time) as lastdate,DATE_FORMAT(date,'%d-%m-%Y') as date from daybook left join ledgers using (ledger_id)join transaction_type on transaction_type.type_id = daybook.transaction_type left join updatelog using (sno) where log_date = CURDATE() or date(lastupdated) = CURDATE()");
			}
				while($row = mysqli_fetch_array($query_show_daybook))
				{
					if($row['transaction_type'] != NULL){
					$first_type_id = $row['type_id'];
					if(isset($prev_type_id)){
					if($first_type_id != $prev_type_id )
					{
//						echo "</tbody></table><br>";
//echo 				"<table style = \"width:100%;border-radius:20px 0px 0px 20px;padding:5px;\"><thead style = \"background:peachpuff;color:grey;border-bottom-style:solid;border-color:black;border-width:1px;\">";
//echo "<tr style = 'background:peachpuff;'><th>Date</th><th>Party Name</th><th>Transaction Type</th><th>Serial #</th><th>Amount</th></tr>";
//echo "</thead>				<tbody>";
				}
			}					

					if($row['type_id'] != 5)
{
//	if($row['last_date'] == date("Y-m-d"))
//	if($row['log_id'] != NULL)
					//	echo "<tr><td style = 'text-align:left;'>".$row['date']." Updated</td><td style = 'text-align:left;'>".$row['ledger_name']."</td><td style = 'text-align:left;'>".$row['type_name']."</td><td style = 'text-align:left;'># ".$row['transaction_id']."</td><td style = 'text-align:right;'>".$row['amount']."</td></tr>";
			//	else	
					echo "<tr onclick = 'insert_details(this.rowIndex,".$row['transaction_id'].",".$row['type_id'].");'><td style = 'text-align:left;'>".$row['date']."</td><td style = 'text-align:left;'>".$row['ledger_name']."</td><td style = 'text-align:left;'>".$row['type_name']."</td><td style = 'text-align:left;'># ".$row['transaction_id']."</td><td style = 'text-align:right;'>".$row['amount']."</td></tr>";
}	
/*				else{
					$new_runner_id = 	$row['ledger_id'];
					echo "<tr><td style = ''>".$row['date']."</td><td style = 'text-align:left;'>".$array_runner[$new_runner_id]."</td><td style = 'text-align:left;'>".$row['type_name']."</td><td style = 'text-align:left;'># ".$row['transaction_id']."</td><td style = 'text-align:right;'>".$row['amount']."</td></tr>";
					$prev_type_id = $row['type_id'];
					}
	*/				

//					echo "<tr><td>".$row['date']."</td><td style = 'text-align:left;'>".$row['ledger_name']."</td><td style = 'text-align:left;'>".$row['type_name']."</td><td style = 'text-align:left;'># ".$row['transaction_id']."</td><td style = 'text-align:right;'>".$row['amount']."</td></tr>";
					$prev_type_id = $row['type_id'];

				}
				}
				?>
<!--				</tbody>
				</table><br>
				<table style = 'width:100%;border-radius:20px; 0px 0px 20px;padding:5px;'>-->
<!--					<thead style = "background:peachpuff;color:grey;border-bottom-style:solid;border-color:black;border-width:1px;">-->

<!--					<tr style = 'background:peachpuff;'><th style = 'padding:10px;'>Date</th><th>Party Name</th><th>Transaction Type</th><th>Serial #</th><th>Amount</th></tr>-->
					<!--</thead>-->
<!--					<tbody>-->
						<?php 
/*						if(isset($date_search))
						{
												if($date_flag == 1)
						$query_receipt = mysqli_query($con,"select *,concat(alpha_serial,receipt_no) as receipt,DATE_FORMAT(date,'%d-%m-%Y') as date from receipt_detail join ledgers using (ledger_id) where date = str_to_date('$date_search','%Y-%m-%d')");
						else
						$query_receipt = mysqli_query($con,"select *,date(lastupdated) as lastdate,concat(alpha_serial,receipt_no) as receipt,DATE_FORMAT(date,'%d-%m-%Y') as date from receipt_detail join ledgers using (ledger_id) where log_date = str_to_date('$date_search','%Y-%m-%d') or date(lastupdated) = str_to_date('$date_search','%Y-%m-%d')");
					}
						else
						{
												if($date_flag == 1)
						$query_receipt = mysqli_query($con,"select *,concat(alpha_serial,receipt_no) as receipt,DATE_FORMAT(date,'%d-%m-%Y') as date from receipt_detail join ledgers using (ledger_id) where date = CURDATE()");
						else
						$query_receipt = mysqli_query($con,"select *,date(lastupdated) as lastdate,concat(alpha_serial,receipt_no) as receipt,DATE_FORMAT(date,'%d-%m-%Y') as date from receipt_detail join ledgers using (ledger_id) where log_date = CURDATE() or date(lastupdated) = CURDATE()");
					}
						while($rowReceipt = mysqli_fetch_array($query_receipt))
						{
if($rowReceipt['logdate'] != $rowReceipt['lastdate'])							
							echo "<tr><td style ='text-align:left'>".$rowReceipt['date']." Updated</td><td style = 'text-align:left;'>".$rowReceipt['ledger_name']."</td><td style = 'text-align:left;'>receipt</td><td style = 'text-align:left;'># ".$rowReceipt['receipt']."</td><td style = 'text-align:right;'>".$rowReceipt['amount']."</td></tr>";
	else						echo "<tr><td style ='text-align:left'>".$rowReceipt['date']."</td><td style = 'text-align:left;'>".$rowReceipt['ledger_name']."</td><td style = 'text-align:left;'>receipt</td><td style = 'text-align:left;'># ".$rowReceipt['receipt']."</td><td style = 'text-align:right;'>".$rowReceipt['amount']."</td></tr>";
						}*/
						?>
<!--					</tbody>-->
				</table>
<!--				<ul style = "list-style:none;border:1px solid grey;padding:0px;display:block;width:100px;text-align:center;">
					<li style = "padding:2px;"> <a class = "day-options">Purchase</a></li>
					<li style = "padding:2px;"><a class = "day-options">Sales</a></li>
				</ul>
-->			</div>
<!--<div style = "display:table-cell;border-left-style:solid;border-color:black;border-width:1px;padding:10px;width:300px;">
	
	<big style = 'color:blue;display:block;text-align:center;'>Payments Due</big>
	<table style = "width:100%;">
		<th>Party Name</th><th>Bill #</th><th>Amount</th>
	</table>
	<hr>
<!--	<big style = 'color:blue;display:block;text-align:center;'>Order list</big>-->
	<?php
/*	$query_books = mysqli_query($con,"select * from items where quantity < quantity_alarm");
	echo "<table style = 'width:100%;'>";
	echo "<th>Item Name</th>";
	while($row_book = mysqli_fetch_array($query_books))
	{
		echo "<tr><td style = 'text-align:left;'>".$row_book['name']."</td></tr>";
	} 
	echo "</table>";*/
	
	?>
<!--</div>-->
</div></Div>
			</div>
		</div>
		
	</body>
</html>
