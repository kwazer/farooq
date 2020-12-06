<?php
class BaseDesign 
{
	public $des1 ="
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
			height:500px;
			padding:2px;
			position:relative;
			background:url(\"pic.png\") center no-repeat;
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
		}
		.inf
		{
			border:1px solid grey;
		}
		
	</style>
	
	<head>
		<title>
			Vintage Voyages
		</title>
	</head>
	<body style=\"padding:2px;\">
		<div id = \"main\">
			<p id = \"logo\" >Vintage Voyages</p>
			<br><br><br>
			
			
			
		</div>
		
	</body>
</html>";
public function showvalue()
	{
		return $des;
	}
}
$obj = new BaseDesign;
echo $obj->showvalue();
?>
