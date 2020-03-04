<?php
  include('includes/header.php');
?>
<title>Login</title>
<?php
//Checks if user is logged in
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

echo'<center>  <form action="logcheck.php" method="post" requi >';
echo'  Username<br> <input type="text" name="username"required ><br>';
echo'  Password<br> <input type="password" name="password" required><br>';
echo'  <input type="submit" value="Login" name="submit">';
echo'</form> </center>';
}
?>
  <?php

  $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


  if (strpos($fullurl, "login=nouser") == true) {
    echo "<p class=> Incorrect username or password! </p>";
    exit();
  }
  if (strpos($fullurl, "login=success") == true) {
    header('Location: logcheck.php?login=success');
  }

  ?>




  <?php
  include('includes/footer.php');
  ?>
