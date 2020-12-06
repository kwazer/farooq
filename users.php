<?php
session_start();
include 'con.php';
$sno = $_REQUEST["type_id"];
$ledger_type = $_REQUEST["type_name"];

//$query_se = mysqli_query($con,"select * From daybook where transaction_type = '$sno' order by transaction_id desc limit 1");
//while($row_se = mysqli_fetch_array($query_se))
//{
	
//	$bil_no = $row_se['transaction_id'];
//}
//	if(isset($bil_no))
//	$bil_no = $bil_no + 1;
//	else
//	$bil_no = 1;

?>
<style>
	.lisst
	{
		color:navy;
		text-align:left;
		
	}
	.user_fields
	{
		height:28px;
		font-size:15px;
		padding:5px;
		border-radius: 0px 5px;
		border:1px solid blue;
	}
	
</style>
<script>

//function del()
//{
//	location.href = 'deleteitem.php?item_id='+item_id;
//}

</script>
<div id = "main-window" style = "width:780px;border: 0px solid black;padding:10px;margin:0 auto;background:white;border-radius:10px;">
<?php
//echo "<form action = \"back".$ledger_type.".php\" method = \"post\" onsubmit = \"return submit_item(this)\">";
echo "<big style = \"font-size:28px;color:grey;letter-spacing:2px;\" >".$ledger_type."</big><span style = \"cursor:pointer;color:brown;margin-left:10px;border:0px solid black;padding:3px;\" onclick = \"location.href='admin_page.php';\">Back</span><br><hr>";
?>
<?php
$query = mysqli_query($con,"select * from users ");
//			echo '	<form method = "post" action= "backusers.php" onsubmit = "return submit_item(this);">';

?>
<form action = "backadduser.php" method = "post" onsubmit = "return submit_item(this);">
<!--<form action = "backadduser.php" method = "post">-->

	<table style = "width:100%;">
<!--		<tbody style = 'border:1px solid black;'>-->
		<tr><th colspan = 3>Add New User</th></tr>
		<tr><th style = 'text-align:left;'>Username</th><td colspan = '2'><input placeholder ='Enter Username' style = 'width:100%;' type = 'text' name = 'username'/></td></tr>
		<tr><th style = 'text-align:left;'>Password</th><td colspan = '2'><input placeholder = 'Enter Password' style = 'width:100%;' type = 'text' name = 'password'</td></tr>
		<tr><th style = 'text-align:left;'>Privialages</th><td colspan = '2'><input placeholder = 'Enter privilages level' style = 'width:100%;' type = 'text' name = 'privilages' /></td></tr>
		<tr><td colspan = '3'><input type = 'submit' /></td></tr>
		<tr><th>User Name</th><th>Password</th><th>privilages</th></tr>
		</table>

		</form>
			<table style = "width:100%;">

		<!--</tbody>-->
	<?php 

	while($row = mysqli_fetch_array($query))
	{
		echo "<input type = 'text' value = '".$row['id']."' style = 'display:none;' name = 'id".$row['id']."' id = 'id".$row['id']."' />";
		echo "<tr><td><input name = 'username".$row['id']."' id = 'username".$row['id']."' type = 'text' value = '".$row['username']."'/></td>";
		echo "<td><input name = 'password".$row['id']."' id = 'password".$row['id']."' type = 'text' value = '".$row['password']."'/></td>";
		echo "<td><input name = 'privilages".$row['id']."' id = 'privilages".$row['id']."' type = 'text' value = '".$row['privilages']."'/></td>";
		echo "<td><input type = 'button' value = 'save' onclick = 'backusers(".$row['id'].")'/></td></tr>";
	}
	echo "	</table> ";
//			echo "</form>";

	?>
		
	

</div>
