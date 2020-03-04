<?php
  include('includes/header.php');
?>

<?php
  session_start();

//check if user is not logged in
	if(!isset($_SESSION['loggedInUser']))
	{ echo'<main style="background-color:;color: #009688; padding:25px;">';
		echo '<center><h2 class="loggedIn"><center> Please login first via login page to view Details </center> </h2>';
	}
  //checks if user is logged in
	else if (isset($_SESSION['loggedInUser']))
	{


		//CONNECTING TO MONGODB
    require __DIR__ . '/vendor/autoload.php';
    $m = (new MongoDB\Client);
		//STORE VALUE OF LOGGED IN USERNAME IN SESSION
		$username = $_SESSION['loggedInUser'];
		//FIND THAT USER
		$findcriteria = [
				'username' => $username
		];
    $db = $m->ecommerce;
	   $collection = $db->user;
		$results = $collection->find(array('username' => $username));


		foreach($results as $result)
  		{
      $_id = $result['_id'];
      $username = $result['username'];
      $password = $result['password'];
  		$firstname = $result['firstname'];
			$lastname = $result['lastname'];
      $address = $result['address'];
			$email = $result['email'];
      $telephone = $result['telephone'];
  		}


//outputs users details

  echo "

		<table class=userTable >

							<tr>
                <td>Username</td>
								<td>First name</td>
								<td>Last name</td>
								<td>Address</td>
              	<td>Email</td>
                <td>Telephone</td>
							</tr>
							<tr>
              	<td>".$username."</td>
								<td>".$firstname."</td>
								<td>".$lastname."</td>
                <td>".$address."</td>
								<td>".$email."</td>
                <td>".$telephone."</td>
							</tr>
			</table>
					";


//Outputs form to edit user details
  echo '<main style="background-color:;color: black; padding:25px;">';
  echo "<center>";
  echo "<h1>Edit Details</h1>";
  echo '<form action="edituser.php" method="post">';
  echo 'First name: <br><input type="text" name="firstname" value="' . $result['firstname'] . '" required><br>';
  echo 'Last name:<br><input type="text" name="lastname" value="' . $result['lastname'] . '" required><br>';
  echo 'Address:<br> <input type="text" name="address" value="' . $result['address'] . '" required><br>';
  echo 'Email: <br><input type="email" name="email" value="' . $result['email'] . '" required><br>';
  echo 'Telephone: <br><input type="text" name="telephone" value="' . $result['telephone'] . '" required><br>';
  echo 'Username:<br> <input type="text" name="username" value="' . $result['username'] . '" required><br>';
  echo 'Password:<br> <input type="password" name="password" value="' . $result['password'] . '" required><br>';
  echo '<input type="hidden" name="id" value="' .$result['_id'] . '" required>';
  echo '<input type="submit">';
  echo '</form><br>';
	}

//outputs logout
if(isset($_SESSION['loggedInUser']))
{

	echo "<a href='logout.php'";
	echo "class='logOut'";
	echo ">";
	echo "Logout";
	echo "</a>";
}

$fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(strpos($fullurl, "change=success") == true)
{
	echo "<p> Account has been updated! </p>";
	exit();
}
?>
</form>
</div>
</div>

<?php
include('includes/footer.php');
?>

</div>
