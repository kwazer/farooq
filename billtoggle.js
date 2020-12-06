		function showdatalist_valueedit(sno)
	{
//		alert("it works");

	var shownvalue = document.getElementById("item_name"+sno).value;
	var datalist = document.getElementById("namelist");
//	alert(shownvalue);
		var value_to_send = document.querySelector("#namelist option[value='"+shownvalue+"']").id;
//		alert(value_to_send);
other_ledgers = value_to_send;
//alert(sno);

document.getElementById("uid"+sno).value = value_to_send;

	}
	
		function showdatalist_valueeedit(sno)
	{
//		alert("it works");

	var shownvalue = document.getElementById("item_name").value;
	var datalist = document.getElementById("namelistt");
//	alert(shownvalue);
		var value_to_send = document.querySelector("#namelistt option[value='"+shownvalue+"']").id;
//		alert(value_to_send);
other_ledgers = value_to_send;
//alert(sno);

document.getElementById("uid").value = value_to_send;

	}
	
	
function update_details(sno)
{
	alert(sno);
	var item_id = document.getElementById("uid"+sno).value;
	var type_id = document.getElementById("type_id"+sno).value;
	alert(item_id);
	var qty = document.getElementById("qty"+sno).value;
	var price = document.getElementById("price"+sno).value;
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
//			alert("changed");
alert(xhr.responseText);
		}
	}
	xhr.open("GET","editbilldetail.php?uid="+item_id+"&qty="+qty+"&price="+price+"&sno="+sno+"&type_id="+type_id,true);
	xhr.send();

}
function add_details(sno)
{
	alert(sno);
	var item_id = document.getElementById("uid").value;
	var type_id = document.getElementById("type_id").value;
	alert(item_id);
	var qty = document.getElementById("qty").value;
	var price = document.getElementById("price").value;
if(qty != "")
{
		var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
//			alert("changed");
alert(xhr.responseText);
		}
	}
	xhr.open("GET","addbilldetail.php?uid="+item_id+"&qty="+qty+"&price="+price+"&sno="+sno+"&type_id="+type_id,true);
	xhr.send();
}

}
function delete_details(sno)
{
	var confirm_deletion = confirm("are you sure");
	if(confirm_deletion)
	{
	//	alert("you have successfully proceeded");
//	alert(sno);
	var item_id = document.getElementById("uid"+sno).value;
	var type_id = document.getElementById("type_id"+sno).value;
//	alert(item_id);
	var qty = document.getElementById("qty"+sno).value;
	var price = document.getElementById("price"+sno).value;
	alert(item_id+" "+type_id+" "+sno+" "+qty+" "+price);
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
//			alert("changed");
alert(xhr.responseText);
		}
	}
	xhr.open("POST","deletebilldetails.php?uid="+item_id+"&qty="+qty+"&price="+price+"&sno="+sno+"&type_id="+type_id,true);
	xhr.send(); 
	}
}
