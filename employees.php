<?php
session_start();
if(!$_SESSION["username"])
{
	header("location:index.html");
} 
include 'con.php'
?>
<html>
	<style>
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
	</style>
<script>
	var global_index;
	function _focus(item_id,ind)
	{
		var element_of_focus = document.getElementById("f"+ind);
//		alert("f"+ind);
		var previous_index = global_index;
		global_index = ind;
		element_of_focus.focus;
		
		if(element_of_focus.style.backgroundColor != "yellow")
		element_of_focus.style.backgroundColor = "yellow";
		else
		element_of_focus.style.backgroundColor = "ivory";
		document.getElementById("f"+previous_index).style.backgroundColor = "ivory";
//		alert(element_of_focus.innerHTML);
	}
	function check_press()
	{
		
		if(event.keyCode == 40)
		{
			var previous_index = global_index;
			global_index = global_index + 1;
//			alert(global_index);
			var eelement_of_focus = document.getElementById("f"+global_index);
//			alert(eelement_of_focus.innerHTML);
			eelement_of_focus.focus;
			eelement_of_focus.scrollIntoView();
			document.getElementById("f"+previous_index).style.backgroundColor = "ivory";
			eelement_of_focus.style.backgroundColor = "yellow";
			event.preventDefault();
//			alert("you have pressed down key");
		}
		if(event.keyCode == 38)
		{
			var previous_index = global_index;
			global_index = global_index - 1;
//			alert(global_index);
			var eelement_of_focus = document.getElementById("f"+global_index);
//			alert(eelement_of_focus.innerHTML);
			eelement_of_focus.focus;
			eelement_of_focus.scrollIntoView();
			document.getElementById("f"+previous_index).style.backgroundColor = "ivory";
			eelement_of_focus.style.backgroundColor = "yellow";
			event.preventDefault();
			
//			alert("you have pressed down key");
		}
		if(event.keyCode == 13)
		{
			var eelement_of_focus = document.getElementById("f"+global_index);
			alert(eelement_of_focus.innerHTML);
		}
	}
	function item_select()
	{
		var number_of_item = prompt("number of items");
		alert("you have chosen "+number_of_item+" no of items");
	}

</script>
	<head>
		<title>
			Vintage Voyages
		</title>
	</head>
	<body style="padding:2px;" onkeydown = "check_press();">
		<div id = "main">
			<p id = "logo" >Super Agencies</p>
			<br>
			<?php
			$ind = 0;
			include 'menubar2.php'; 
			?>
			
			<div style = "padding:10px;width:94%;background:white;min-height:498px;margin:5px auto;border:5px solid grey;border-radius:10px;">
			<big style = "font-size:22px;display:block;letter-spacing:4px;color:grey;border-bottom-style:solid;border-width:1px;border-color:grey;padding-top:3px;text-align:center;">Purchase</big>
			<table style = "width:25%">
				<th >Item Name</th><th>Qty</th>
				<?php
				$query = mysqli_query($con,"select * From item join category on item.cat_id = category.cat_id order by item_name");
				while($row = mysqli_fetch_array($query))
				{ 
				
				
				
				
			echo '<tr  style = "border:1px solid grey;"><td id = "f'.$ind.'" ondblclick = "item_select()" class = "sub_menu" style = "border-width:1px;text-align:left;" onclick = "_focus('.$row['item_id'].','.$ind.')"><span id = '.$row['item_id'].'>'.$row['item_name'].'('.$row['cat_name'].')</span></td><td class = "sub_menu" style = "border-width:1px;text-align:center;">'.$row['item_qty'].'</td></tr>';
			$ind = $ind + 1;
		}
			?>
			</table>
			</div>
		</div>
		
	</body>
</html>
