<?php
  include('includes/header.php');
?>

<?php
  session_start();

//check if user is not logged in
	if(!isset($_SESSION['loggedInUser']))
	{
  echo '<main style="background-color:;color: #009688; padding:25px;">';
		echo '<center><h2 class="loggedIn"><center> Please login first via login page to view Orders </center> </h2>';
    echo '</main>';
	}

  //if user is logged in it will connect to the database to find the orders of that username.
	else if(isset($_SESSION['loggedInUser']))
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
    //Select collection in Database
	  $collection = $db->order;

//Indexed search
  $find1 = [
      '$text' => [ '$search' => $username ]
   ];
    $cursor = $collection->find($find1);

	echo "

						<table class=userTable >

							<tr>
								<td>Address</td>
                <td>Date</td>
                <td>Time</td>
                <td>Product Name</td>
                <td>Product ID</td>
                <td>Price</td>
                <td>Quantity</td>
							</tr>";

              //loop that outputs all orders for the specific customer
              foreach($cursor as $result)
                {
						echo "<tr>";
						echo "<td>".$result['shipping_address']."</td>";
						echo "<td>".$result['date']."</td>";
						echo "<td>".$result['time']."</td>";
            echo " <td>".$result['product-name']."</td>";
            echo " <td>".$result['product-id']."</td>";
            echo " <td>£".$result['price']."</td>";
            echo " <td>".$result['quantity']."</td>";
					  echo " </tr>";

	           }

    }
?>

<div id="login-box">
</form>

</div>
</div>

<?php
include('includes/footer.php');
?>

</div>
