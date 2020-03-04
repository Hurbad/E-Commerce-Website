<?php
  include('includes/header.php');
?>

<?php
session_start();

$prodIDs= $_POST['prodIDs'];

//Convert JSON string to PHP array
$productArray = json_decode($prodIDs, true);

if(isset($_POST['prodIDs']) && isset($_SESSION['loggedInUser'])){


  //Include libraries
  require __DIR__ . '/vendor/autoload.php';

  //Create instance of MongoDB client
  $mongoClient = (new MongoDB\Client);

  $username = $_SESSION['loggedInUser'];
  //FIND THAT USER
  $findcriteria = [
      'username' => $username
  ];
//Connect to Database
  $db = $mongoClient->ecommerce;
//Connect to User Collection
   $collection = $db->user;
//Connect to Order Collection
   $collection2 = $db->order;
  $results = $collection->find(array('username' => $username));

  foreach($results as $result)
    {
    $username = $result['username'];
    $email = $result['email'];
    $address = $result['address'];
    }

    $time = date("h:i:sa", strtotime('-1 hour'));
    $date = date("Y/m/d");

    //Add the new user to the database
    echo '<main style="position:inherit;width:1850px; height: 1000px; color:white;">';
    echo ' <p onload="javascript:emptyBasket()"></p>';
    echo '<p>Thank You, '.$username.'<br>Here is Your Order Details <hr>';

//loops through the Customers Order and sends each order to the Database
    for($i=0; $i<count($productArray); $i++){

        $dataArray = [
            "customer" => $username,
            "shipping_address" => $address,
            "date" => $date,
            "time" => $time,
            "product-name"=>  $productArray[$i]['name'],
            "product-id"=> $productArray[$i]['id'],
            "price"=> (int) $productArray[$i]['price'],
            "quantity"=>  $productArray[$i]['count']

         ];
         //inserts each order after processing it in the loop
          $insertResult = $collection2->insertOne($dataArray);
          //shows each order that was processed
echo '<p> Name: '
. $productArray[$i]['name']
.'<br>Product ID: '
. $productArray[$i]['id']
 . '<br> Price: £' .
  $productArray[$i]['price']
  . '<br> Quantity: ' .
  $productArray[$i]['count'] .
   '<hr></p>';
    }
}

//checks if user is logged in
if (!isset($_SESSION['loggedInUser'])) {
  echo '<main style="background-color:;color: #009688; padding:25px;">';
  echo'<h1> You need to sign in before you can complete this transaction </h1>';
}
 ?>
<script src="script/basket.js"></script>


 <?php
 include('includes/footer.php');
 ?>
