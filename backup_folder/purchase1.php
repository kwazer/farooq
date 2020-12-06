<?php
session_start(); 
$billl = $_GET["bill_no"];
$con = mysqli_connect("localhost","root","password","shop");
//$query_sel = mysqli_query($con,"insert into bills(bill_date) values(CURDATE())");
$query_se = mysqli_query($con,"select * From bills order by bill_no desc limit 1");
while($row_se = mysqli_fetch_array($query_se))
{
	
	$bil_no = $row_se['bill_no'];
}
if(isset($billl))
{
	$bil_no=$billl;
	
}
else
{
	if(isset($bil_no))
	$bil_no = $bil_no + 1;
	else
	$bil_no = 1;
}
//echo $bil_no;
$query_clear_prenter = mysqli_query($con,"delete from temp_detail where bill_id = $bil_no");
?>
<html>
	<script>
		var bill_n = <?php echo $bil_no;?>;
	</script>
<head>
	<style>
		a
		{
			text-decoration:none;
		}
		.oplis:hover
		{
			color:red;
		}
	</style>
	<script src = "jquery-1.9.0.min.js"></script>
	<script>
			document.onclick = function(e)
	{
		if(e.target != document.getElementById("ser"))
		{
document.getElementById("ser").innerHTML = "";
		}
	}
	var grid;
function searchitem(str){
			var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState ==4 && xmlhttp.status == 200)
		{
			document.getElementById("ser").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","finditem.php?id="+str,true);
	xmlhttp.send();
}

function selectitem()
{
//	if(!table_id)
//	{
//		alert("No table selected");
//	}
//alert(bill_n);
//alert(grid)
	var nos = document.getElementById("qty").value;
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
xmlhttp.open("GET","billback.php?item_id="+grid+"&qty="+nos+"&bill_no="+bill_n,true);
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
var currentRow = 0;
function changes()
{
	var tableRow = document.getElementById("sero").rows[currentRow].cells[0];
	tableRow.focus();
}

function traverse(val)
{
var cin = document.getElementById("sero").rows.length;
cin = cin -1;
if(val == 'up' && currentRow < cin)
{
		currentRow++;
}
		if(val == 'down' && currentRow !=0){
		currentRow--;
		}
				changes();
		if(currentRow == 0 && val == 'down' )
				document.getElementById("ls").focus();

		return false;
}
function selecteditem(item_id)
{
grid = item_id;
	var news = document.getElementById("ls");
	var dat = document.getElementById(item_id);
	news.value = dat.innerHTML;
	document.getElementById("ser").innerHTML = "";
document.getElementById("qty").focus();
currentRow = 0;
}
function item_minus(sno,item_id)
{
//	alert(sno+" "+item_id);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			document.getElementById("lows").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","iteminus.php?sno="+sno+"&bill_no="+bill_n+"&item_id="+item_id,true);
	xmlhttp.send();

}
	</script>
		<style>
		td
		{
			text-align:center;
//			text-transform:uppercase;
		}
		th
		{
			text-transform:uppercase;
		}
		
	
		
	</style>
	<style>
		th{
			color:white;
			background:#2C5463;
			font-weight:normal;
			text-align:center;
		}
	</style>
	
	<body onkeyup = "if(event.keyCode == 27) location.href = 'index.php';">
<div style = "width:700px;margin:0 auto;border:1px solid black;padding:5px;background-color:ivory;">
		<ul style="position:fixed;width:680px;list-style:none;background-color:peachpuff;padding:10px;color:grey;border-bottom:3px solid grey;margin:-1px auto;border-top:0px solid grey;">
		<li style = "display:inline;margin:0px 10px;"><a href="index.php" style = "text-decoration:none;color:grey;">Home</a></li>

		
	</ul>
<div style="margin-top:50px;">	
<label>Enter bill No </label><input type = "text" />
	<div style="border:0px solid grey;padding:10px;border-radius:10px;background-color:ivory;margin:0 auto;">		
<table id = "sero" tabindex = "444" style = "position:absolute;z-index=2;background:silver;border:1px solid grey;border-collapse:collapse;" onkeypress = "if (event.keyCode == 40)traverse();" onblur = "clod()">
<tr><td onkeydown = "if(event.keyCode == 40) return false;" style = "padding:0px;background:white;width:250px;">		<input autofocus style = "border:2px solid green;width:100%;height:23px;" type="text" list="listshow" id="ls" name="list" onKeyUp="if(event.keyCode == 40) traverse('up');else searchitem(this.value);"></td></tr>
<tbody id = "ser">
</tbody>
	</table>
	<div style = "dislay:inline;margin-left:260px;width:125px;">
	<input type="number"  id="qty" value="1" min="1" style = "display:inline;float:left;width:50px;height:23px;border:2px solid green;margin-top:1px;">
	<button id="searchbtn" onclick="selectitem()" style = "display:inline;float:right;margin-top:1px;height:23px;">Enter</button></div>
	<br><br>
	<div id = "lows"><ul>
		<li><span style = "color:brown;font-size:12px;">Please enter the items to get started</span></li>
		<li><span style = "color:brown;font-size:12px;">DO NOT REFRESH THE PAGE BEFORE SAVING THE DATA BY CLICKING CASH OR CREDIT/CASH BUTTON</span></li>		
	</ul>
	</div>
	<div style = "margin-left:400px;">
<?php echo '<a href="endpage.php?bill_no='.$bil_no.'" style = "border:1px solid grey;position:relative;display:block;background-color:peachpuff;width:100px;text-align:center;padding:4px;border-radius:5px;margin:4px;">Cash</a>';
//echo '<a href = "index.php">Save</a>';
//echo '<a href = "index.php">cancel</a>';
echo '<a href="selectledger.php?bill_no='.$bil_no.'" style = "border:1px solid grey;position:relative;display:block;background-color:peachpuff;width:100px;text-align:center;padding:4px;border-radius:5px;margin:4px;">Credit/Cash</a>';

?>

</div>

</div>
</div>
</div>
	</body>
	</html>
