<ul>

<?php

foreach ($navItems as $item) {

echo "<li><a href=\"$item[slug]\">$item[title]</a></li>";
}
 ?>
 <div style="float:right">
 <li><a href="basket.php"class="#"><img src="images/basket.png"style="width:px;height:24px;padding:1px"></a></li>
 </div>
 <div class="search-container"> <form action="searched.php" method="get">
    <input type="text" name="name" placeholder="Search" required>
    <input type="submit">
    </form> </div>


<li style="float:left" class="dropdown">
<a href="#" class="circle2">Account</a>


<div class="dropdown-content">
<a href="login.php"class="circle2">Log In</a>
<a href="signup.php"class="circle2">Signup</a>
<a href="details.php"class="circle2">Details</a>
<a href="orders.php"class="circle2">Orders</a>


</div>

</ul>
