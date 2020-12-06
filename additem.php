<style>
	.lis
	{
		border:1px solid grey;
		height:28px;
		width:300px;
		padding:2px;
		font-size:15px;
		font-weight:normal;
	}
	#mainw
	{
		border:0px solid black;
		margin:0 auto;
//		width:800px;
		padding:10px;
		background-color:white;
		border-radius:10px;
	}
	td
	{
		padding:2px;
	}
</style>

<?php
$cat_id = $_GET["cat_id"];
$cat_name = $_GET["cat_name"];
 
?>
<div id = "mainw">
	<script>
	var cat_id = <?php echo $cat_id;?>;
	var set_name = "<?php echo $cat_name;?>";
/*	function additem()
	{
//		alert("it works");
		var name = document.getElementById("add_name").value;
		var price = document.getElementById("add_price").value;
		var sprice = document.getElementById("add_sprice").value;
		var qty =  document.getElementById("add_qty").value;
		var rem_qty = document.getElementById("add_rem_qty").value;
		var pos = document.getElementById("add_pos").value;
		var unt = document.getElementById("add_unt").value;
//alert(name+price+sprice+qty+rem_qty+pos+unt);
var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function ()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
//				location.reload();
//alert(cat_id,set_name);
//				location.href = 'index.php?set_cat='+cat_id+'&set_name='+set_name;
window.location.assign("index.php?set_cat="+cat_id+"&set_name="+set_name);

//alert("it works");
			}
		}
		xmlhttp.open("GET","backadditem.php?name="+name+"&price="+price+"&pos="+pos+"&cat_id="+cat_id+"&qty="+qty+"&rem_qty="+rem_qty+"&sprice="+sprice+"&unt="+unt,true);
		xmlhttp.send();
	}*/
</script>
<?php //echo '<form action = "addbooks.php" method = "post">'; ?>
<?php echo "<form action = \"addbooks.php\" method = \"post\" onsubmit = \"return submit_item(this)\">";?>
<!--<?php //echo "<form action = \"addbooks.php\" method = \"get\" id = \"item_form\" onsubmit = \"additem($cat_id,'".$cat_name."')\">";?>-->
<big style = "font-size:28px;color:grey;letter-spacing:2px;"><?php echo $cat_name;?></big><span style = "font-size:20px;color:grey;"> Item insertion</span> <?php echo "<span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"redirect_back(".$cat_id.",'".$cat_name."')\">Back</span>";?><br><hr>
<table>
	<input type="text" value= "<?php echo $cat_id;?>" name  = "publisher" style = "display:none;"/>
<!--<tr><td><span>ISBN</span></td><td><input autofocus class = "lis" type = "text" name= "isbn" placeholder="ISBN" id = "isbn" autofocus onkeypress= "if(event.keyCode == 13) return isbn_();"/></td></tr>-->
<tr><td><span>Name</span></td><td><input class = "lis" type = "text" name= "item_name" placeholder="Item Name" id = "add_name" autofocus onkeypress= "if(event.keyCode == 13) document.getElementById('max_price').focus();"/></td></tr>
<!--<tr><td><span>Selling Price</span></td><td><input class = "lis" type =  "text" id = "max_price" name = "mrp" placeholder = "price on the book" onkeypress= "if(event.keyCode == 13) document.getElementById('cost_price').focus();"/></td></tr>-->
<tr><td><span>Cost Price</span></td><td><input class = "lis" type =  "text" id = "cost_price" placeholder = "publisher Discount" name = "publisher_discount" onkeypress= "if(event.keyCode == 13) document.getElementById('dealer_price').focus();"/></td></tr>
<tr><td><span>Dealer Price</span></td><td><input class = "lis" type =  "text" id = "dealer_price" name = "dealer_discount" placeholder="dealer discount" onkeypress= "if(event.keyCode == 13) document.getElementById('mrp_discount').focus();"/></td></tr>
<tr><td><span>Sales Price</span></td><td><input class = "lis" type =  "text" placeholder= "retail discount" name = "retail_discount" id = "mrp_discount" onkeypress= "if(event.keyCode == 13) document.getElementById('add_qty').focus();"/></td></tr>
<tr><td><span>Qty</span></td><td><input class = "lis" type =  "text" id = "add_qty" name = "opening_qty" placeholder = "opening quantity" onkeypress= "if(event.keyCode == 13) document.getElementById('add_pos').focus();"/></td></tr>
<!--<tr><td><span>Position</span></td><td><input class = "lis" type =  "text" id = "add_pos" onkeypress= "if(event.keyCode == 13) document.getElementById('add_rem_qty').focus();"/></td></tr>-->
<!--<tr><td><span>Order if Less than</span></td><td><input class = "lis" type =  "text" id = "add_rem_qty" name = "alarm_qty" placeholder="alarm Qty"onkeypress= "if(event.keyCode == 13) document.getElementById('add_unt').focus();"/></td></tr>-->
<!--<tr><td><span>Author</span></td><td><select name="author" id="author" class="lis">
										<?php
//										include 'con.php';
//										$query_author = mysqli_query($con,"select * From author");
//										while($row_authors = mysqli_fetch_array($query_author))
//										{
//										echo "<option value = ".$row_authors['author_id'].">".$row_authors['author_name']."</option>";
//										}

										?>
										
									</select></td></tr>-->

</table>
<input type="submit" value="confirm"/>

</form>
</div>
