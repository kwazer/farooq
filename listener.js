document.addEventListener("keydown", checkfunction, false);
function checkfunction(e) {
var keyCode = e.keyCode;
//alert(keyCode);
  if(keyCode==114 && e.altKey) {
	  var dest = prompt("enter the name of the page");
	  if(dest != null)
	  if(dest != "")
	  location.href= "selectpage.php?name="+dest;
  }
  if(keyCode == 120)
  {
	  location.href= 'ledgers.php';
  }
  if(keyCode == 119)
  {
	  location.href= 'transactions.php';
  }
  if(keyCode == 118)
  {
	  location.href= 'searchpage.php';
  }
  if(keyCode == 115)
  {
	  location.href= 'home.php';
  }
  if(keyCode == 113)
  {
	  location.href= 'itempage.php';
  }
    if(keyCode==65 && e.altKey) {
		location.href= 'emi_setting.php';
}
}
