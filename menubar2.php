
<?php 
session_start();
?>

		<style>
			// for sub menu 
			
		#cssmenu {padding: 0; margin: 0; border: 0;}
#cssmenu ul, #cssmenu li {list-style: none; margin: 0; padding: 0;text-align:center;}
#cssmenu ul {position: relative; z-index: 597; }
#cssmenu ul li { float: left; min-height: 1px; vertical-align: middle;width:190px;border-radius:20px;}
#cssmenu ul li.hover,
#cssmenu ul li:hover {position: relative; z-index: 599; cursor: default;}
#cssmenu ul ul {visibility: hidden; position: absolute; top: 100%; left: 0; z-index: 598; width: 100%;}
#cssmenu ul ul li {float: none;}
#cssmenu ul ul ul {top: 0; left: auto; right: -99.5%; }
#cssmenu ul li:hover > ul { visibility: visible;}
#cssmenu ul ul {bottom: 0; left: 0;}
#cssmenu ul ul {margin-top: 0; }
#cssmenu ul ul li {font-weight: normal;}
#cssmenu a { display: block; line-height: 1em; text-decoration: none; }


#cssmenu {
  background: #333;
//  border-top:1px solid white;
//  border-bottom: 3px solid #2C5463;
border : 1px solid white;
  font-family: 'Oxygen Mono', Tahoma, Arial, sans-serif;
  font-size: 12px; 
}

  #cssmenu > ul { *display: inline-block; }

  #cssmenu:after, #cssmenu ul:after {
    content: '';
    display: block;
    clear: both; 
}


#cssmenu a {
    background: #333;
    color: #CBCBCB;
    padding: 0 20px; 
}
#cssmenu ul { text-transform: uppercase; }

    #cssmenu ul ul {
      border-top: 1px solid white;
      text-transform: none;
      min-width: 170px; 
}
      #cssmenu ul ul a {
        background: #2C5463;
        color: #FFF;
        border: 1px solid white;
        border-top: 0 none;
        line-height: 120%;
        padding: 8px 10px; 
}
      #cssmenu ul ul ul { border-top: 0 none; }

      #cssmenu ul ul li { position: relative }
      
      
      #cssmenu > ul > li > a { line-height: 28px;  }

#cssmenu ul ul li:first-child > a { border-top: 1px solid #0082e7; }
        #cssmenu ul ul li:hover > a { background: #35a6ff; }

        #cssmenu ul ul li:last-child > a {
          border-radius: 0 0 3px 3px;
          box-shadow: 0 1px 0 #1b9bff; 
}
        #cssmenu ul ul li:last-child:hover > a { border-radius: 0 0 0 3px; }

        #cssmenu ul ul li.has-sub > a:after {
          content: '+';
          position: absolute;
          top: 50%;
          right: 15px;
          margin-top: -8px;
}

    #cssmenu ul li:hover > a, #cssmenu ul li.active > a {
      background: #1b9bff;
      color: #FFF;
}
    #cssmenu ul li.has-sub > a:after {
      content: '+';
      margin-left: 5px; 
}
    #cssmenu ul li.last ul {
      left: auto;
      right: 0; 
}
      #cssmenu ul li.last ul ul {
        left: auto;
        right: 99.5%;
}
#noon 
{
	background: #333;
    color: #CBCBCB;
    padding: 0 20px; 
    line-height: 28px;
}

</style>

<span>User : <?php echo $_SESSION["username"];?></span> <span style = 'margin-left:20px;background:white;padding:3px;border-radius:5px;font-size:14px;'><span style = 'color:brown;margin-left:10px;'>F4</span><span style = 'color:blue;'> : Home</span><span style = 'color:brown;margin-left:10px;'>F7</span><span style = 'color:blue;'> : Search</span><span style = 'color:brown;margin-left:10px;'>F2</span><span style = 'color:blue;'> : Item Page</span><span style = 'color:brown;margin-left:10px;'>F3</span><span style = 'color:blue;'> : In Page Search</span><span style = 'color:brown;margin-left:10px;'>F8</span><span style = 'color:blue;'> : Transaction</span><span style = 'color:brown;margin-left:10px;'>F9</span><span style = 'color:blue;'> : Ledger</span><span style = 'color:brown;margin-left:10px;'>Alt + A</span><span style = 'color:blue;'> : Emi setting</span> </span>
<div id='cssmenu' style = "padding-left:5px;width:99%;margin:0 auto;border-radius:5px;">
  <ul>
     <li ><a href='home.php'>Home</a>
<!--        <ul>
			
           <li class='has-sub '><a href='#'>Sales</a>
              <ul>
                 <li><a href='billedsales.php'>Billed Sales</a></li>
                 <li><a href='#'>Unbilled sales</a></li>
              </ul>
           </li>
           <li><a href="purchases.php">Purchase</a></li>
           


           
        </ul>-->
     </li>
     
<!--  -->     
     <li class='has-sub '><a href='#'>Reports</a>
        <ul>
			
<?php     if($_SESSION['privilage']==1) {echo"      <li class='has-sub '><a href='#'>Selective</a>
              <ul>
                 <li><a href='limitedsearch.php'>Sales</a></li>
                 <li><a href='daybookreport.php'>Daybook</a></li>
                 <li><a href='itemreport.php'>Item</a></li>
                 

              </ul>
           </li>"; }?>
           <li><a href="print_statement.php">Fruit Statement</a></li>
           <li><a href="ledger_statement.php">Ledger Statement</a></li>
           <?php if($_SESSION['privilages']==1) echo '<li><a href="fruit_search.php">Fruit Search</a></li><li><a href="fruit_account.php">Fruit Account</a></li>';?>
           <li><a href="daybook.php">Daybook</a></li>
           <li><a href="stocks.php">Stock</a></li>
           <li><a href="purchasereports.php">Purchase</a></li>
<!--           <li><a href="statement.php">Statement</a></li>-->
      <li> <a href="limitedannual.php">Annual Return</a></li>
 <?php     echo     "<li class = 'has-sub'><a>Yearly</a>
           <ul>
			   <li><a href= \"";if(isset($_SESSION['pass']) || $_SESSION['privilage'] == 1){ echo "salesreport.php\"";}else{ echo "taxreport.php\"";} echo " >Sales</a></li>
"; if($_SESSION['privilage'] == 1)	echo "		   <li><a href= \"exporeport.php\">Daybook</a></li>
			   
			   <li><a href= \"reports1.php\">Item/Category</a></li>";echo "

           </ul>
           </li> ";?>
           
        </ul>
     </li>
     <li class='has-sub'><a href='#'>Accounts</a>
		<ul>
<?php 
if($_SESSION['privilage'] == 1)
{
/*echo'				<li class = \'has-sub\'><a href="daybook.php">Daybook</a>
				<ul>
					<li><a href = "expensereport.php">Edit</a></li>
				</ul>
				</li>';
			}
				else
				{*/
/*				echo'				<li class = \'has-sub\'><a href="daybook.php">Daybook</a>
				<ul>
					<li><a href = "expensereport.php">Edit</a></li>
				</ul>
				</li>';*/
				}
?>
				<li ><a href="ledgers.php">Ledgers</a>
<!--				<ul>
					<li><a href = "#">Edit</a></li>
				</ul>-->
				</li>
				<!--<li><a href="employees.php">Employees</a>-->
				</li>
				<li><a href="transactions.php">Transactions</a></li>
				<!--<li><a href="purchase.php">Purchase</a></li>-->
				<li><a href="itempage.php">Item Page</a></li>
				<li><a href="emi_setting.php">Emi Setting</a></li>
				<li><a href="searchpage.php">Search</a></li>
				<li><a href="admin_page.php">Admin Page</a></li>
				<li><a href="pands.php">Payment & Receipt reports</a></li>
				<li><a href="salepage.php">Sale Page</a></li>

		</ul>
		
     </li>
     <?php
     if($_SESSION['privilage'] == 1)
     {
		 echo '
     <li class = \'has-sub\'><a href="">Settings</a>
     <ul>
		 <li><a href="itempage.php">Items</a></li>
		 <li><a href="waiter.php">Password</a></li>
		 <li><a href="taxtable.php">Discount</a></li>

     </ul>
     </li>';}
     ?>
     <li><a href="logout.php">logout</a>
     </li>
<!--     <li class = 'has-sub'><a href = "fabrication.php">Body Fabrication</a>
     <ul>
		 <li> <a href= "addfabricationorder.php">Place an order</a></li>
		 <li> <a href= "creditors.php">fabrication dealers</a></li>
     </ul>
     </li>-->
     <li ><span id = "noon" style = "color:white;"  >Date :<b><?php echo date("d-m-Y",strtotime(now));?></b></span></li>
  </ul>
</div>

