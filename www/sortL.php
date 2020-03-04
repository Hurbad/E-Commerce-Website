<?php
  include('includes/header.php');
?>

<?php
//connect
require __DIR__ . '/vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->ecommerce;
$sort = [];
//Find all products
$collection = $db->product;
//sorts from low to high
$cursor = $collection->find(
  [],
  [
    'sort' => ['price' => 1]
  ]
);

//Output the table
echo '<main style="position:inherit;width:1850px; height: 1000px;  background-color:rgba(0,0,0,0);border: 0px solid rgba(0,0,0,0);">';
echo'<form action="sortH.php">
<button class="button" type="submit" > High-Low </button>
</form>';
echo'<form action="sortL.php">
<button class="button" type="submit" > Low-High </button>
</form>';
echo '<table class=userTable >';
echo '<tr><th>ID</th>
<th>Name</th>
<th>Colour</th>
<th>Picture</th>
<th>Size</th>
<th>Price</th>
<th>Quantity</th>
<th>Checkout</th>
</tr>';
//outputs sorted results
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
