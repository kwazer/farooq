<?php
session_start();
if($_SESSION["id"] != 1)
{
	header('location:home.php');
}
 
$set_cat = $_GET["set_cat"];
$set_name = $_GET["set_name"]; 

?>
<script src="searchasyoutype.js"></script>
<script src="listener.js"></script>
<style>
	::-webkit-scrollbar
	{
		display:none;
	}
	a
	{
		text-decoration:none;
	}
	div{
		font-size:15px;
	}
	td
	{
		text-align : center;
		padding:5px;
		
		
	}
//	th
//	{
//		font-weight:normal;
//	}
	.lio
	{
//		margin:0px;
		color:grey;
//		background-color:grey;
	}
			#main
		{
			border:1px solid grey;
			margin:0 auto;
			max-width:1000px;
			min-height:800px;
			padding:5px;
			position:relative;
			overflow:hidden;
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
		.sub_menu:hover
		{
//			color:red;
			border-color:red;
			border-width:2px;
			border-bottom-style:solid;
			border-radius:0px;
			cursor:pointer;
//			background:peachpuff;
		}
		.sub_menu 
		{
			border-width:0px 
			border-color:grey;
			border-bottom-style:solid;
			color:grey;
			letter-spacing:1px;
			background:ivory;
			padding:5px;
			border-radius:1px;
			font-size:12px;
			
		}
		th
		{
			font-weight:normal;
			color:brown;
			letter-spacing:2px;
		}
				.item_list:hover
				{
					color:red;
				}
				

</style>
<script>
	var tran_type;
</script>
<?php 
if(isset($_GET["set_cat"]))
{
//	$cunt = 1;
echo "<body onload = \"clio(".$set_cat.",'".$set_name."')\">";
}
else 
{
//	$cunt = 2;
echo "<body>";
}
?>

<body style = "margin:0px;" onkeyup = "if(event.keyCode == 13 && event.altKey && tran_type == 2){ confirm_sales(tran_type)}">

<div id = "main"  >
				<p id = "logo" >FAROOQ ELECTRONICS</p>
			<br>
			<?php
			$ind = 0;
echo "<div style = 'margin-top:-18px;'>";
			include 'menubar2.php'; 
			?>
</div>
<!--	<ul style="position:fixed;width:77%;list-style:none;background-color:peachpuff;padding:10px;color:grey;border-bottom:3px solid grey;margin:-1px auto;border-top:0px solid grey;">
		<li style = "display:inline;margin:0px 10px;"><a href="index.php" style = "text-decoration:none;color:grey;">Home</a></li>
		<li style = "display:inline;margin:0px 10px;"><a href="ledgers.php" style = "text-decoration:none;color:grey;">Ledgers</a></li>
		<li style = "display:inline;margin:0px 10px;">Index</li>
		<li style = "display:inline;margin:0px 10px;">Index</li>
		
	</ul>
-->	
<div id = "sub-content" style = "">
<div style = "position:fixed;top:100px;border:0px solid black;padding:5px;background:white;overflow-y:auto;overflow-x:hidden;max-height:530px;border-radius:10px;">
	<script>
		var g_cat;
		var g_catname;
		function addcate()
		{
			var cate = document.getElementById("cate").value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function()
			{
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					location.reload();
//alert(cate);
				}
			}
		xmlhttp.open("GET","backcatadd.php?cat_id="+cate,true);
		xmlhttp.send();
		}
	function clio(caty,catna)
	{
		g_cat = caty;
		g_catname = catna;
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
						document.getElementById("prose").innerHTML =  xmlhttp.responseText;

			}
		}
		xmlhttp.open("GET","backitem page.php?cat_id="+caty+"&cat_name="+catna,true);
		xmlhttp.send();
	}
	function orderlist()
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function ()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("prose").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","orderlist.php",true);
		xmlhttp.send();
	}
	
	function show_itempage(category_name,category_id,item_id)
	{
				var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function ()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("prose").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","edititem.php?item_id="+item_id+"&cat_name="+category_name+"&cat_id="+category_id,true);
		xmlhttp.send();

	}
		function redirect_back(cat_id,set_name)
	{
//			window.location.assign("itempage.php?set_cat="+cat_id+"&set_name="+set_name);
clio(cat_id,set_name);
//			location.href = "itempage.php?set_cat="+cat_id+"&set_name="+set_name;
	}
		function savves(cat_id,set_name,item_id)
	{
//		alert(set_name);
//		alert("recievers data");
		var name = document.getElementById("name_item").value;
		var price = document.getElementById("price_item").value;
		var position = document.getElementById("position_item").value;
		var qty = document.getElementById("qty_item").value;
		var rem_qty = document.getElementById("rem_qty_item").value;
		var sprice = document.getElementById("sprice_item").value;
		var unt = document.getElementById("unt_item").value;
		var model = document.getElementById("model_item").value;
		var type = document.getElementById("type_item").value;
//alert(name+price+position);
		var xmlhttp1 = new XMLHttpRequest();
		xmlhttp1.onreadystatechange = function ()
		{
			if(xmlhttp1.readyState == 4 && xmlhttp1.status == 200)
			{
				clio(cat_id,set_name);
//				location.reload();
//				location.href = 'index.php?set_cat='+cat_id;
//window.location.assign("itempage.php?set_cat="+cat_id+"&set_name="+set_name);
//alert("it works");
			}
		}		
		xmlhttp1.open("GET","backedititem.php?name="+name+"&price="+price+"&position="+position+"&item_id="+item_id+"&qty="+qty+"&rem_qty="+rem_qty+"&sprice="+sprice+"&unt="+unt+"&model="+model+"&type="+type,true);
		xmlhttp1.send();
	}
	function del(cat_id,set_name,item_id)
{
			var xmlhttp1 = new XMLHttpRequest();
		xmlhttp1.onreadystatechange = function ()
		{
			if(xmlhttp1.readyState == 4 && xmlhttp1.status == 200)
			{
				clio(cat_id,set_name);
			}
		}		
		xmlhttp1.open("GET","deleteitem.php?item_id="+item_id,true);
		xmlhttp1.send();

//	location.href = 'deleteitem.php?item_id='+item_id;
}
function add_item(cat_id,cat_name)
{
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
				document.getElementById("prose").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","additem.php?cat_name="+cat_name+"&cat_id="+cat_id,true);
		xmlhttp.send();

	}
		function ledgerdetail(led_id,led_name)
	{
//		alert("it works");
//		var name = document.getElementById("add_name").value;
//		var price = document.getElementById("add_price").value;
//		var sprice = document.getElementById("add_sprice").value;
//		var qty =  document.getElementById("add_qty").value;
//		var rem_qty = document.getElementById("add_rem_qty").value;
//		var pos = document.getElementById("add_pos").value;
//		var unt = document.getElementById("add_unt").value;
//alert(name+price+sprice+qty+rem_qty+pos+unt);

var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function ()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
//				location.reload();
//alert(cat_id,set_name);
//				location.href = 'index.php?set_cat='+cat_id+'&set_name='+set_name;
//window.location.assign("index.php?set_cat="+cat_id+"&set_name="+set_name);
//				clio(cat_id,set_name);
				document.getElementById("prose").innerHTML = xmlhttp.responseText;

//alert("it works");
			}
		}
		xmlhttp.open("GET","ledgerdetail.php?led_name="+led_name+"&led_id="+led_id,true);
		xmlhttp.send();
	}
	function add_ledger(sno)
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("prose").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","addledger.php?sno="+sno,true);
		xmlhttp.send();
	}
function editledger(led_id,led_name)
{
	alert(led_id+led_name);
/*			var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("prose").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","editledger.php?led_id="+led_id+"&led_name="+led_name,true);
		xmlhttp.send();
*/
}
var g_type_name;
var g_type_id;
function transaction_types(type_id,type_name,year)
{
//alert(year);
	g_type_name = type_name;
	g_type_id = type_id;
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			document.getElementById("prose").innerHTML = xhr.responseText;
			tran_type = type_id;
		}
	}
if(year != "")
xhr.open("GET",type_name+".php?type_id="+type_id+"&type_name="+type_name+"&year="+year,true);
else
	xhr.open("GET",type_name+".php?type_id="+type_id+"&type_name="+type_name,true);
	xhr.send();
}
function submit_item(oFormElement)
{
//	alert("it works");
			    var xhr = new XMLHttpRequest();
 xhr.onreadystatechange=function()
 {
	 if(xhr.readyState == 4 && xhr.status == 200)
	 {
//		if(g_type_id == 4 || g_type_id == 6 || g_type_id == 5 || g_type_id == 7)
//		{
//			alert("successful ! Please click Ok to proceed");
location.href  = 'admin_page.php';
alert(xhr.responseText);
//transaction_types(g_type_id,g_type_name);

//		} 
	 }
 }
  xhr.open (oFormElement.method, oFormElement.action, true);
  xhr.send (new FormData (oFormElement));
			  return false;
}

function submit_sale(oFormElement)
{
	
//	var uid = document.createElement("input");
//	uid.name = "uid";
//	uid.value = grid;
//	oFormElement.appendChild(uid);
//document.getElementById("ls").value = grid;
var value_to_check = document.getElementById("uid").value;
//alert(value_to_check);
//if(value_to_check == grid)
//{
			    var xhr = new XMLHttpRequest();
 // xhr.onload = function(){ clio(g_cat,g_catname); }
 xhr.onreadystatechange=function()
 {
	 if(xhr.readyState == 4 && xhr.status == 200)
	 {
//		 location.reload();
document.getElementById("sale_output").innerHTML = xhr.responseText;
document.getElementById("ls").value = "";
document.getElementById("ls").focus();
//		 alert(xhr.responseText);
//		 clio(g_cat,g_catname);
	 }
 }
// xhr.open("GET","backsale.php?uid="+grid,true);
// xhr.send();
  xhr.open (oFormElement.method, oFormElement.action, true);
  xhr.send (new FormData (oFormElement));
//			  alert("it works perfectly");

			  return false;

//}
}
/*
function transaction_payment()
{
//	if(!table_id)
//	{
//		alert("No table selected");
//	}
//alert(bill_n);
//alert(grid)
	var transaction_type = document.getElementById("transaction_type").value;
	var serial_no = document.getElementById("serial_no").value;
	var nos = document.getElementById("figure_amount").value;
	var other_ledger = document.getElementById("mode_of_transfer").value;
	if(nos>0)
	{
		
//	for(var i = 0;i<nos;i++)
//	{
//	document.getElementById("r"+grid).onclick();
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function()
{
	if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
	{
//		location.reload();
document.getElementById("lows").innerHTML = xmlhttp.responseText;
	}
}
xmlhttp.open("GET","backpayment.php?ledger_id="+grid+"&amount="+nos+"&bill_no="+serial_no+"&transaction_type="+transaction_type+"&other_ledger="+other_ledger,true);
xmlhttp.send();
//location.reload();
//}
document.getElementById("ls").focus();
	document.getElementById("ls").value = "";
	
//	document.getElementById("ls").focus();
}

else 
{
	alert("ENTER VALID INPUT");
}
document.getElementById("qty").value=1;
}
*/
function backusers(id)
{
	
	var username = document.getElementById("username"+id).value;
	var password = document.getElementById("password"+id).value;
	var privilages = document.getElementById("privilages"+id).value;
	//alert(username+" "+password+" "+privilages);
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 2 && xhr.status == 200)
		{
//			transaction_type(g_type_id,g_type_name);
//						alert(xhr.responseText);
alert("successful");

		}
	}
	xhr.open("POST","backusers.php?id="+id+"&username="+username+"&password="+password+"&privilages="+privilages,true);
	xhr.send();
}

function submit_backsales(buid)
{
//	alert(buid);
//	if(!buid)
//alert("it works");
	var uid = document.getElementById("uid").value;
	var qty = document.getElementById("qty").value;
	var amount = document.getElementById("figure_amount").value;
//		if(!uid)
//	{
//else
//		var uid = buid;
//	}

//	alert(uid);
var transaction_type = document.getElementById("transaction_type").value;
	var xhr  = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			alert("item added");
			document.getElementById("sale_output").innerHTML = xhr.responseText;
			document.getElementById("ls").value = "";
document.getElementById("ls").focus();
//alert(transaction_type);
//if(transaction_type == 4)
//{
//	alert(xhr.responseText);
//}

		}
	}
//	xhr.open("GET","backsale.php?uid="+uid+"&transaction_type="+transaction_type,true);
//if(transaction_type == 1)
//{
//	var purchase_bill_no = document.getElementById("purchase_bill_no").value;
//	xhr.open("GET","back"+g_type_name+".php?uid="+uid+"&transaction_type="+transaction_type+"&pur_bil_no="+purchase_bill_no,true);
//}
//else
//	{
		xhr.open("GET","back"+g_type_name+".php?uid="+uid+"&transaction_type="+transaction_type+"&amount="+amount+"&qty="+qty,true);
//	}
	xhr.send();
	
}
function value_by_barcode(barcode_value)
{
//	alert(barcode_value);
if(barcode_value != "")
{
	var xhr  = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
//			alert(xhr.responseText);
//			document.getElementById("sale_output").innerHTML = xhr.responseText;
submit_backsales(xhr.responseText);
		}
	}
	xhr.open("GET","backbarcode_value.php?barcode_value="+barcode_value,true);
	xhr.send();
}	
}
var other_ledgers;
	function confirm_sales(transaction_type)
	{
//		alert("it works");
		var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState ==4 && xmlhttp.status == 200)
		{
//			document.getElementById("item_section").innerHTML = xmlhttp.responseText;
//			document.getElementById("focusedinput").value = "";
alert(xmlhttp.responseText);
//location.reload();
transaction_types(g_type_id,g_type_name);
//if(transaction_type == 2)
//document.getElementById("ls").focus();
		}
	}
//if(transaction_type == 1)
//{
//	var purchase_bill_no = document.getElementById("purchase_bill_no").value;
	//	xmlhttp.open("GET","confirm_sales.php?type_id="+transaction_type+"&led_id="+other_ledgers+"&pur_bil_no="+purchase_bill_no,true);

//}
if(transaction_type == 3 || transaction_type == 1)
{
	var date = document.getElementById("date").value;
//alert(emiAmount);
	var receipt_narration = document.getElementById("receipt_narration").value;
	//alert(receipt_narration);
		if(transaction_type == 3)
{	var emiAmount = document.getElementById("emiAmount").value;

		xmlhttp.open("GET","confirm_sales.php?type_id="+transaction_type+"&led_id="+other_ledgers+"&receipt_narration="+receipt_narration+"&emiAmount="+emiAmount+"&date="+date,true);
	}
	if(transaction_type == 1)
	{
		xmlhttp.open("GET","confirm_sales.php?type_id="+transaction_type+"&led_id="+other_ledgers+"&receipt_narration="+receipt_narration+"&date="+date,true);
		
	}

}
else
{	
	xmlhttp.open("GET","confirm_sales.php?type_id="+transaction_type+"&led_id="+other_ledgers,true);
}
	xmlhttp.send();	
		
	}
	
		function showdatalist_value(sno)
	{
//		alert("it works");

	var shownvalue = document.getElementById("example_input").value;
	var datalist = document.getElementById("exampleList");
//	alert(shownvalue);
		var value_to_send = document.querySelector("#exampleList option[value='"+shownvalue+"']").id;
//		alert(value_to_send);
other_ledgers = value_to_send;
//alert(sno);
if(sno == 4 || sno == 6 )
{
//	alert(value_to_send);
	document.getElementById("account_no").value = value_to_send;
//var myArray = new Array();
//var myArray = value_to_send.split(/[0-9+/);
//var new_value = myArray[1];
var regex = /(\d+)/g;
alert(value_to_send.match(regex));
	document.getElementById("uid").value = value_to_send.match(regex);

}
document.getElementById("other_ledger").value = value_to_send;

	}
	
function alter_qty(sno,new_qty,price)
{
//	alert(new_qty);
var xhr = new XMLHttpRequest();
xhr.onreadystatechange= function()
{
	if(xhr.readyState == 4 && xhr.status == 200)
	{
	document.getElementById("p"+sno).innerHTML = price*new_qty;
	document.getElementById("grand_total").innerHTML = xhr.responseText;
	}
}
xhr.open("GET","change_buffer_qty.php?sno="+sno+"&qty="+new_qty+"&type_id="+g_type_id,true);
xhr.send();
}

//// functions for admin page
function confirm_admin(type_id,sno)
{
//	alert(type_id+" "+sno);
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
//			location.reload();
alert(xhr.responseText);
transaction_types(g_type_id,g_type_name);
		}
	}
	xhr.open("POST","confirm_admin.php?type_id="+type_id+"&sno="+sno,true);
	xhr.send()
}

	</script>

<?php 

include 'con.php';
//$con  = mysqli_connect("localhost","root","password","shop");
$query = mysqli_query($con,"select * from fruit_account ");
echo "<div style = \"background:white;\">";
echo "<table border = \"0\" style = \"border-collapse:collapse;\" cellspacing = \"2px\" style = 'background:white;'>";

//echo '<tr><td><input type = "text" style = "height:22px;padding:2px;font-size:12px;" autofocus id = "ledger_name" onkeypress  = "if(event.keyCode == 13)enterledger();"/></td></tr>';
echo "<tr><td><a href=\"#\" style = \"text-decoration:none;color:black;\">Admin Controls</a></td></tr>";
while($row = mysqli_fetch_array($query))
{
	echo "<tr style = 'background:white;'><td class = \"lio\" style = \"padding:1px;text-align:left;\"><a style = \"text-decoration:none;cursor:pointer;font-size:12px;display:block;background-color:white;padding:6px;text-transform:capitalize;border-radius:0px;border-bottom-style:solid;border-color:pink;border-width:1px;\" onclick = \"transaction_types(".$row['control_id'].",'".$row['control_name']."')\">".$row['control_name']."</a> </td></tr>";
} 
?>
<!--//echo "<tr><td><a href = \"orderlist.php\">Order List</a></td></tr>";
echo "<tr><td><a onclick = \"orderlist()\">Order List</a></td></tr>";
echo "<tr><td><input type = \"text\" id = \"cate\" onkeypress = \"if(event.keyCode == 13)addcate();\"/></td></tr>";

echo "</table>";
echo "</div>";
?>-->
</table>
</div>
</div>
<div style = "border-left: 0px solid black;width:780px;margin-left:180px;margin-top:20px;padding:5px;background:white;padding:0px;border-radius:10px 0px;" id= "prose">
	<!--<ul>
		<li><a href="purchase.php">Purchase ledger</a></li>
		<li><a href="menu4.php">Sales ledger</a></li>
		<li><a href="menu3.php">Inward sale</a></li>
		<li><a href="incomplete.php">incomplete bills</a></li>
		<li><a href="salesreport.php">sales report</a></li>
		<li><a href="ledgerslist.php">Edit Ledgers</a></li>			

	</ul>-->

</div>
</div>
</div>
</body>
