<?php
  include('includes/header.php');
?>
<title>Signup</title>

<?php
//checks if user is logged in
session_start();
if(isset($_SESSION['loggedInUser']))
{
echo '<main style="background-color:;color: #009688; padding:25px;">';
echo '<center><h2 class="loggedIn"><center> You are already LoggedIn</center> </h2>';
echo "<a href='logout.php'";
echo "class='logOut1'";
echo ">";
echo "Logout";
echo "</a>";
echo "</main>";
}

//checks if user is not logged in
else if(!isset($_SESSION['loggedInUser']))
{
echo '<main style="background-color:;color: #009688; padding:25px;">';
echo '<center>  <form action="registrationDB.php" method="post" >
      First Name<br> <input type="text" name="firstname" required><br>
      Last Name<br> <input type="text" name="lastname" required><br>
      Address<br> <input type="text" name="address" required><br>
      Telephone<br> <input type="text" name="telephone" required><br>
      Email<br> <input type="email" name="email" required><br>
      Username<br> <input type="text" name="username" required><br>
      Password<br> <input type="password" name="password" required><br>
      <input type="submit" value="Register">
  </form> </center>';
}
?>
  <?php
//Gets URL
  $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//If User exists
if(strpos($fullurl, "signup=exists") == true)
  {
  	echo "<p> This username already exists </p>";
  	exit();
  }
  //If Registration is successful
  else if(strpos($fullurl, "signup=success") == true)
  {
  	echo "<p> Account has been created! </p>";
  	exit();
  }
  ?>

<?php
include('includes/footer.php');
?>
