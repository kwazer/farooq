function fill_baardana(year,tr_type,led_id)
{
	alert(year+" "+tr_type+" "+led_id);
 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
	{
			document.getElementById("baardana_detail").innerHTML = xhr.responseText;
	}
 }
 xhr.open("GET","baardana_detail.php?year="+year+"&tr_type="+tr_type+"&led_id="+led_id,true);
 xhr.send();
}
function fill_watakk(year,tr_type,led_id)
{
	alert(year+" "+tr_type);
 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
	{
			document.getElementById("baardana_detail").innerHTML = xhr.responseText;
	}
 }
 xhr.open("GET","watakk_detail.php?year="+year+"&tr_type="+tr_type+"&led_id="+led_id,true);
 xhr.send();

}

function create_challan()
{
 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
	{
			document.getElementById("display-pod").innerHTML = xhr.responseText;
	}
 }
 xhr.open("GET","create_challan.php",true);
 xhr.send();

}
function create_watak()
{
 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
	{
			document.getElementById("display-pod").innerHTML = xhr.responseText;
	}
 }
 xhr.open("GET","create_watak.php",true);
 xhr.send();

}
		function showb_value()
	{
//		alert("it works");

	var shownvalue = document.getElementById("b_input").value;
	var datalist = document.getElementById("exampleList");
		var value_to_send = document.querySelector("#exampleList option[value='"+shownvalue+"']").id;
		alert(value_to_send);
document.getElementById("ledger_id").value = value_to_send;

	}
	var global_sundry_fruit ="";
		function showsf_value(tran_id)
	{
//		alert("it works");
//alert(global_tran_id);
	var shownvalue = document.getElementById("sundry_fruit_input").value;
	var datalist = document.getElementById("sundry_fruit");
		var value_to_send = document.querySelector("#sundry_fruit option[value='"+shownvalue+"']").id;
		//document.getElementById("ledger_id").
		global_sundry_fruit = value_to_send;
	}
		//alert(value_to_send);
//		if(event.keyCode == 13)
//		{

function sub_button()
{
	if(global_sundry_fruit != "")
	{
 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
	{
			//document.getElementById("display-pod").innerHTML = xhr.responseText;
			alert(xhr.responseText);
						global_sundry_fruit = "";

	}
 }
xhr.open("GET","submitledger.php?ledger_id="+global_sundry_fruit+"&tran_id="+global_tran_id,true);
// xhr.open("GET","submitledger.php",true);
 xhr.send();
}
	//	}
		//alert(value_to_send);
//document.getElementById("ledger_id").value = value_to_send;

	}
	function list_challan()
	{
 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
	{
			document.getElementById("display-pod").innerHTML = xhr.responseText;
	}
 }
 xhr.open("GET","listchallan.php",true);
 xhr.send();

	}
	function list_watak()
	{
 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
	{
//		document.getElementById("tran_id").value = "";
			document.getElementById("display-pod").innerHTML = xhr.responseText;

	}
 }
 xhr.open("GET","listwatak.php",true);
 xhr.send();

	}
function add_watak(tran_id)
{
//	alert("it works");
 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
	{
			document.getElementById("display-pod").innerHTML = xhr.responseText;
	}
 }
 xhr.open("GET","add_watak.php?tran_id="+tran_id,true);
 xhr.send();

}
var global_tran_id;
function add_watak_entry(tran_id)
{
	global_tran_id = tran_id;
	//alert(tran_id);
 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
	{
			document.getElementById("display-pod").innerHTML = xhr.responseText;
	}
 }
 xhr.open("GET","add_watakentry.php?tran_id="+tran_id,true);
 xhr.send();

}

function show_valuesb(sno)
{
		var shownvalue = document.getElementById("sundry_input"+sno).value;
	var datalist = document.getElementById("sundry_fruit");
		var value_to_send = document.querySelector("#sundry_fruit option[value='"+shownvalue+"']").id;
//		global_sundry_fruit = value_to_send;
//alert(sno);
var x = confirm("are you sure you want to save the changes ");
if(x == true)
{
 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
	{
alert(xhr.responseText);
	}
 }
 xhr.open("GET","sb_update.php?tran_id="+sno+"&ledger_id="+value_to_send,true);
 xhr.send();
}
else
alert("no changes made");

}

function submit_marka(tran_id)
{
//	alert(tran_id);
//if(event.keyCode == 13)
//{
var confirm_submit = confirm("Press ok to confirm");
if (confirm_submit == true)
{
var marka = document.getElementById("marka").value;
var peti = document.getElementById("peti").value;
var dabba = document.getElementById("dabba").value;
var kind = document.getElementById("kind").value;
var gross = document.getElementById("gross").value;
var expenses = document.getElementById("expenses").value;
var net = document.getElementById("net").value;
//alert(marka+peti+kind+dabba+" "+gross+" "+expenses+" "+net+" "+tran_id);
//if(marka != "")
//{
 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
	{
//			document.getElementById("display-pod").innerHTML = xhr.responseText;
alert(xhr.responseText);
//list_challan();
add_watak(tran_id);
document.getElementById("marka").select();
	}
 }
// xhr.open("GET","backadd_watak.php?tran="+tran_id+"&marka="+marka+"&peti="+peti+"&dabba="+dabba+"&kind="+kind+"&gross="+gross+"&expenses="+expenses+"&net="+net,true);
 xhr.open("GET","backadd_watak.php?tran_id="+tran_id+"&marka="+marka+"&peti="+peti+"&dabba="+dabba+"&kind="+kind+"&gross="+gross+"&expenses="+expenses+"&net="+net,true);
 xhr.send();
}
//}
}

function fill_amount()
{
//  alert("this is fill amount");
	var rate = document.getElementById("rate").value;
	var half = document.getElementById("half").value;
	var peti = document.getElementById("peti").value;
	if(peti == 0)
{
	var amount = document.getElementById("amount").value = rate * half;
}
else
{
	var amount = document.getElementById("amount").value = rate * peti;
}

//if(event.keyCode == 13)
//{
//  alert("you clicked enter");
  var variety = document.getElementById("variety").value;
//  alert(variety);
  var quality = document.getElementById("quality").value;
  //alert(rate+" "+peti+" "+half+" "+amount+" "+variety+" "+quality);
  var xhr =  new XMLHttpRequest();
  xhr.onreadystatechange = function()
  {
    if(xhr.readyState == 4 && xhr.status == 200)
    {
      document.getElementById("watak-pod").innerHTML = xhr.responseText;
//     alert(xhr.responseText);
document.getElementById("peti").value = document.getElementById("half").value = document.getElementById("variety").value = document.getElementById("quality").value = document.getElementById("rate").value = document.getElementById("amount").value = "";
document.getElementById("peti").select();
    }
  }

  xhr.open("GET","fill_watak_pod.php?peti="+peti+"&half="+half+"&rate="+rate+"&amount="+amount+"&variety="+variety+"&quality="+quality,true);
  xhr.send();
//}


}

function lock_other(element_name)
{
document.getElementById(element_name).value = 0;
}

function form_submit(oFormElement)
{
//	return false;
//	event.preventDefault();
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function ()
{
	if(xhr.readyState == 4 && xhr.status == 200)
	{
//		alert("works");
alert(xhr.responseText);
var watak = xhr.responseText;
document.getElementById("tran_id").value = watak;
fill_watak_pod(watak_no);
//document.getElementById("button_tab").innerHTML = document.getElementById("button_swap").innerHTML;
//document.getElementById("button_swap").innerHTML = "";
	}
}
  xhr.open (oFormElement.method, oFormElement.action, true);
  xhr.send (new FormData (oFormElement));


}

/*function fill_watak_pod(tran_id)
{
	//alert(tran_id);
 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
	{
			document.getElementById("watak-pod").innerHTML = xhr.responseText;
	}
 }
 xhr.open("GET","fill_watak_pod.php?tran_id="+tran_id,true);
 xhr.send();
		}
*/


function add_items()
{
	var peti = document.getElementById("peti").value;
	var dabba = document.getElementById("dabba").value;
	var variety = document.getElementById("variety").value;
	var quality = document.getElementById("quality").value;
	var rate = document.getElementById("rate").value;
	var amount = document.getElementById("amount").value;
 var xhr = new XMLHttpRequest();
 xhr.onreadystatechange = function()
 {
 if(xhr.readyState == 4 && xhr.status == 200)
	{
			document.getElementById("watak-pod").innerHTML = xhr.responseText;
	}
 }
 xhr.open("GET","add_watakentry.php?tran_id="+tran_id,true);
 xhr.send();

}

function submit_watak()
{
//  alert("it works");
  var date = document.getElementById("date").value;
  var party = document.getElementById("party").value;
  var challan = document.getElementById("challan").value;
  var party = document.getElementById("party").value;
  var marka = document.getElementById("marka").value;
  var truck = document.getElementById("truck").value;
  var freight = document.getElementById("freight").value;
  var comm = document.getElementById("comm").value;
  var labour =document.getElementById("labour").value;
  var postage = document.getElementById("postage").value;
  var ass = document.getElementById("ass").value;
  var texp = document.getElementById("texp").value;
//  alert(date+" "+party+" "+challan+" "+marka+" "+truck+" "+freight+" "+comm+" "+labour+" "+postage+" "+ass+" "+texp);
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function()
  {
    if(xhr.readyState == 4 && xhr.status == 200)
    {
      location.reload();
alert(xhr.responseText);

    }
  }
  xhr.open("GET","createwatak.php?date="+date+"&party="+party+"&challan="+challan+"&marka="+marka+"&truck="+truck+"&freight="+freight+"&comm="+comm+"&labour="+labour+"&postage="+postage+"&ass="+ass+"&texp="+texp,true);
  xhr.send();
}

function update_amounts(new_value,field,sno)
{
//	alert("it works");
	if(event.keyCode == 13)
	{
	var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function()
  {
    if(xhr.readyState == 4 && xhr.status == 200)
    {
//      location.reload();
		alert(xhr.responseText);
    }
  }
	xhr.open("GET","update_amount.php?sno="+sno+"&field="+field+"&new_value="+new_value,true);
	xhr.send();
	}
}
function update_challan(sno)
{
	//alert("this works");
	var date = document.getElementById("challan_date").value;
//var ledger_id = document.getElementById("ledger_id").value;
var led_id = document.getElementById("ledger_id").value;
  var challan_id = document.getElementById("narration").value;
	var xhr = new XMLHttpRequest();
	//alert(date+" "+challan_id+" "+sno+" ");
//alert(ledger_id);
  xhr.onreadystatechange = function()
  {
    if(xhr.readyState == 4 && xhr.status == 200)
    {
//      location.reload();
		alert(xhr.responseText);
    }
  }
	xhr.open("GET","update_challan_date.php?date="+date+"&challan_id="+challan_id+"&sno="+sno+"&ledger_id="+led_id,true);
	xhr.send();

}
function update_sfruit_payment()
{
	var date = document.getElementById("date").value;
	var narration = document.getElementById("narration").value;
	var ledger_id = document.getElementById("ledger_id").value;
	var amount = document.getElementById("amount").value;
	var sno = document.getElementById("sno").value;
	var xhr = new XMLHttpRequest();
	//alert(date+" "+challan_id+" "+sno+" ");
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
//      location.reload();
		alert(xhr.responseText);
		}
	}
	xhr.open("GET","backsearch_fruit_payment.php?date="+date+"&ledger_id="+ledger_id+"&sno="+sno+"&amount="+amount+"&narration="+narration,true);
	xhr.send();
}
function update_sfruit_receipt()
{
//	alert("it works");
        var date = document.getElementById("date").value;
        var narration = document.getElementById("narration").value;
        var ledger_id = document.getElementById("ledger_id").value;
        var amount = document.getElementById("amount").value;
        var sno = document.getElementById("sno").value;
        var xhr = new XMLHttpRequest();
        //alert(date+" "+challan_id+" "+sno+" ");
        xhr.onreadystatechange = function()
        {
                if(xhr.readyState == 4 && xhr.status == 200)
                {
//      location.reload();
                alert(xhr.responseText);
                }
        }
        xhr.open("GET","backsearch_sfruit_receipt.php?date="+date+"&ledger_id="+ledger_id+"&sno="+sno+"&amount="+amount+"&narration="+narration,true);
        xhr.send();

}


function fill_s_ledger_id()
{
                var shownvalue = document.getElementById("sfruit_input").value;
        var datalist = document.getElementById("eList");
                var value_to_send = document.querySelector("#eList option[value='"+shownvalue+"']").id;
        //      alert(value_to_send);
document.getElementById("s_ledger_id").value = value_to_send;
}

