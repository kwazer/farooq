<?php
session_start();
if($_SESSION["id"] != 1)
{
	header('location:home.php');
}

$set_cat = $_GET["set_cat"];
$set_name = $_GET["set_name"]; 

?>
<script src = 'listener.js'></script>
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
			min-height:700px;
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

<body style = "margin:0px;" onkeyup = "if(event.keyCode == 27) location.href = 'index.php';">

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
		function addpublisher()
		{
//			alert("it works");
//			alert(catd);
			var pb_name = document.getElementById("cate").value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function()
			{
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
//					alert("category added");
					location.reload();
//					location.href = 'itempage.php?set_cat='+catd+'set_name='+catnam;
//					clio(catd,catnam);
//alert(cate);
				}
			}
		xmlhttp.open("GET","backrunneradd.php?pb_name="+pb_name,true);
		xmlhttp.send();
		}
		function addauthor()
		{
			var author_name = document.getElementById("author_name").value;
			var xhr =  new XMLHttpRequest();
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					location.reload();
				}
			}
			xhr.open("GET","backauthoradd.php?name="+author_name,true);
			xhr.send();
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
		xmlhttp.open("GET","backrunners.php?cat_id="+caty+"&cat_name="+catna,true);
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
	
	function show_itempage(publisher_name,publisher_id,item_id,alpha_serial,book_begin,book_end)
	{
				var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function ()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("prose").innerHTML = xmlhttp.responseText;
				alert(item_id);
			}
		}
		xmlhttp.open("GET","bookpage.php?item_id="+item_id+"&cat_id="+publisher_id+"&alpha_serial="+alpha_serial+"&book_begin="+book_begin+"&book_end="+book_end,true);
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
				g_cat = cat_id;
				g_catname = cat_name;
			}
		}
		xmlhttp.open("GET","issue_book.php?cat_name="+cat_name+"&cat_id="+cat_id,true);
		xmlhttp.send();

	}
		function additem(cat_id,set_name)
	{
//		alert("it works");
		var isbn = document.getElementById("isbn").value;
		var name = document.getElementById("add_name").value;
		var mrp = document.getElementById("max_price").value;
		var publisher_discount = document.getElementById("cost_price").value;
		var max_price = document.getElementById("max_price").value;
		var dealer_discount = document.getElementById("dealer_price").value;
		var retail_discount = document.getElementById("mrp_discount").value;
		var opening_qty =  document.getElementById("add_qty").value;
		var alarm_qty = document.getElementById("add_rem_qty").value;
		var pos = document.getElementById("add_pos").value;
		var author = document.getElementById("author").value;
		alert(isbn,name,mrp,publisher_discount,max_price,dealer_discount,retail_discount,publisher_discount);
//alert(name+price+sprice+qty+rem_qty+pos+unt);
/*var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function ()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
//				location.reload();
//alert(cat_id,set_name);
//				location.href = 'index.php?set_cat='+cat_id+'&set_name='+set_name;
//window.location.assign("index.php?set_cat="+cat_id+"&set_name="+set_name);
				clio(cat_id,set_name);

//alert("it works");
			}
		}
		xmlhttp.open("GET","addbooks.php?isbn="+isbn+"&name="+name+"&mrp="+mrp+"&publisher_discount="+publisher_discount+"&publisher="+cat_id+"&opening_qty="+opening_qty+"&alarm_qty="+alarm_qty+"&max_price="+max_price+"&dealer_discount="+dealer_discount+"&retail_discount="+retail_discount+"&author="+author,true);
		xmlhttp.send();
*/	}
function submit_item(oFormElement)
{
//	alert("it works");
//	document.getElementById("item_form").submit();
		  {
			    var xhr = new XMLHttpRequest();
 // xhr.onload = function(){ clio(g_cat,g_catname); }
 xhr.onreadystatechange=function()
 {
	 if(xhr.readyState == 4 && xhr.status == 200)
	 {
		 clio(g_cat,g_catname);
//		 alert(xhr.responseText);
	 }
 }
  xhr.open (oFormElement.method, oFormElement.action, true);
  xhr.send (new FormData (oFormElement));
//			  alert("it works perfectly");

			  return false;
		  }
//clio(g_cat,g_catname);
return false;

}

function isbn_()
{

	document.getElementById('add_name').focus();
	return false;	
}
function showauthors()
{
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			document.getElementById("prose").innerHTML = xhr.responseText
		}
	}
	xhr.open("GET","showauthors.php",true);
	xhr.send();
}
function editauthor(author_id)
{
	var author_name = document.getElementById("author_name"+author_id).value;
		xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
//			alert(xhr.responseText);
			alert("changes saved");
			showauthors();
//			document.getElementById("prose").innerHTML = xhr.responseText
		}
	}
	xhr.open("GET","editauthors.php?author_id="+author_id+"&author_name="+author_name,true);
	xhr.send();
}
function showpublishers()
{
		xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			document.getElementById("prose").innerHTML = xhr.responseText
		}
	}
	xhr.open("GET","showrunner.php",true);
	xhr.send();
	
}
function editpublisher(pb_id)
{
	//alert(pb_id);
	var pb_name = document.getElementById("runner_name"+pb_id).value;
	//alert (pb_name);
		xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
//			alert(xhr.responseText);
			alert("changes saved");
			showpublishers();
//			document.getElementById("prose").innerHTML = xhr.responseText
		}
	}
	xhr.open("GET","editrunners.php?pb_id="+pb_id+"&pb_name="+pb_name,true);
	xhr.send();
}
function check_amount(cash_amount,book)
{
//	alert(cash_amount);
//	alert(book);
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			alert(xhr.responseText);
			if(xhr.responseText == 'matches')
			location.reload();
		}
	}
	xhr.open("POST","backreceived_cash.php?amount="+cash_amount+"&book="+book,true);
	xhr.send();
	
}
	var other_ledgers;
			function showdatalist_value()
	{
//		alert("it works");

	var shownvalue = document.getElementById("eexample_input").value;
	var datalist = document.getElementById("eexampleList");
//	alert(shownvalue);
		var value_to_send = document.querySelector("#eexampleList option[value='"+shownvalue+"']").id;
//		alert(value_to_send);
other_ledgers = value_to_send;
alert(other_ledgers);
document.getElementById("other_ledgers").value = value_to_send;

	}

function cancel_receipt(alpha_serial,receipt_no)
{
//	alert("it works");
//	alert(alpha_serial+' '+receipt_no);
var confirm_cancel = confirm("are you sure");
if(confirm_cancel)
{
//	alert("you chose to cancel");
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			alert(xhr.responseText);
//			if(xhr.responseText == 'matches')
			location.reload();
		}
	}
	xhr.open("POST","cancel_receipt.php?alpha_serial="+alpha_serial+"&receipt_no="+receipt_no,true);
	xhr.send();


}
}
	</script>
<?php 
include 'con.php';
//$con  = mysqli_connect("localhost","root","password","shop");
$query = mysqli_query($con,"select * from runner order by runner_name");
echo "<div style = \"\">";
echo "<table border = \"0\" style = \"border-collapse:collapse;\" cellspacing = \"2px\">";
echo "<tr><td class = 'lio' style = 'passing:1px;'><a href=\"emi_setting.php\" style = \"text-decoration:none;cursor:pointer;font-size:12px;display:block;background-color:white;padding:6px;text-transform:capitalize;border-radius:0px;border-bottom-style:solid;border-color:pink;border-width:1px;color:grey;\" >Edit Runner</a></td></tr>";
while($row = mysqli_fetch_array($query))
{
	echo "<tr><td class = \"lio\" style = \"padding:1px;\"><a style = \"text-decoration:none;cursor:pointer;font-size:12px;display:block;background-color:white;padding:6px;text-transform:capitalize;border-radius:0px;border-bottom-style:solid;border-color:pink;border-width:1px;\" onclick = \"clio(".$row['runner_id'].",'".$row['runner_name']."')\">".$row['runner_name']."</a></td></tr>";
}
//echo "<tr><td><a href = \"orderlist.php\">Order List</a></td></tr>";
//echo "<tr><td><a onclick = \"orderlist()\">Order List</a></td></tr>";
echo "<tr><td style = 'font-size:12px;color:brown;'>Press Enter to Save Changes</td></tr>";
echo "<tr><td><input type = \"text\" id = \"cate\" placeholder = \"Add runner Here\" onkeypress = \"if(event.keyCode == 13)addpublisher();\"/></td></tr>";
//echo "<tr><td><input type = \"text\" id = \"author_name\" placeholder = \"Add Author Here\" onkeypress = \"if(event.keyCode == 13)addauthor();\"/></td></tr>";

echo "</table>";
echo "</div>";
?>
</div>
<div style = "border-left: 0px solid black;width:730px;margin-left:215px;margin-top:20px;padding:5px;" id= "prose">
	<ul>
<!--		<li style = "background:ivory;margin:5px;padding:10px;border-radius:10px 2px;"><span onclick = "showauthors()" style = "cursor:pointer;">Edit Authors</span></li>-->
		<li style = "background:ivory;margin:5px;padding:10px;border-radius:10px 2px;"><span onclick = "showpublishers()" style = "cursor:pointer;">Edit Runner</span></li>

	</ul>
</div>
</div>
</div>
</body>
