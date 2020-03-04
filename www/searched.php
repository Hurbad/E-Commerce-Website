<?php
  include('includes/header.php');
?>

<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';

//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->ecommerce;

//Extract the data that was sent to the server
$search_string = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);

//Create a PHP array with our search criteria
$findCriteria = [
    '$text' => [ '$search' => $search_string ]
 ];

//Find all of the product that match  this criteria
$cursor = $db->product->find($findCriteria);

//Output the results
echo '<main style="position:inherit;width:1850px; height: 1000px; color:white;">';
echo '';
echo '<table>';
echo '<tr><th>ID</th>
<th>Name</th>
<th>Colour</th>
<th>Picture</th>
<th>Size</th>
<th>Price</th>
<th>Quantity</th>
<th>Checkout</th>
</tr>';
echo "<h1>Results</h1>";
foreach ($cursor as $document){
    echo '<tr>';
    echo '<td>' . $document["product-id"] . "</td>";
    echo '<td>' . $document["name"] . "</td>";
    echo '<td>' . $document["colour"] . "</td>";
    echo '<td><img src="'. $document["image_url"] .'"height=100 width=100></img></td>';
    echo '<td>' . $document["size"] . "</td>";
    echo '<td>£' . $document["price"] . "</td>";
    echo '<td>' . $document["quantity"] . "</td>";
    echo '<td><button onclick=\'addToBasket("' . $document["product-id"] . '", "'
    . $document["name"] .'", "'
    . $document["colour"] .'", "'
    . $document["size"] . '", "'
    . $document["price"] .'", "'
    . $document["image_url"] .
      '")\'>';
    echo '<img class="addButtonImg" width=20 src="images/basket-add-icon.png"></button></td>';
    echo '</tr>';
}

?>
<script src="script/basket.js"></script>
<?php
include('includes/footer.php');
?>
