
			document.onclick = function(e)
	{
		if(e.target != document.getElementById("ser"))
		{
document.getElementById("ser").innerHTML = "";
		}
	}
	var grid;
	var g_type_id;
function searchitem(str,type_id,led_flag){
//	alert(type_id);
//if(event.keyCode == 13)
//{
//	return false;
//}
//else
//{

g_type_id = type_id; 
			var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState ==4 && xmlhttp.status == 200)
		{
			document.getElementById("ser").innerHTML = xmlhttp.responseText;
		}
	}
if(led_flag == 'true')
	xmlhttp.open("GET","finditem.php?id="+str+"&type_id="+type_id+"$led_flag=true",true);
else
	xmlhttp.open("GET","finditem.php?id="+str+"&type_id="+type_id,true);
	xmlhttp.send();
	 
//}
}
function selectitem()
{
//	if(!table_id)
//	{
//		alert("No table selected");
//	}
//alert(bill_n);
//alert(grid)
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
//alert(item_id);
//alert(g_type_id);

	var news = document.getElementById("ls");
	if(g_type_id == 3 || g_type_id == 1 || g_type_id == 2 || g_type_id == 10)
{	var dat = document.getElementById("i"+item_id);}
else
{
	var dat = document.getElementById(item_id);}
	document.getElementById("uid").value=grid;
	news.value = dat.innerHTML;
	document.getElementById("ser").innerHTML = "";
//	alert(news.value);
	
//	if(g_type_id == 2)
//	{
//		submit_backsales();
//		alert("type 2");
//		if(event.keyCode == 13)
//		{
//			submit_backsales();
//		}
//	}
//	else
document.getElementById("qty").focus();
currentRow = 0;

//return false;
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
