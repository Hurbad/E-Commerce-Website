<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';

//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->ecommerce;

//Select a collection
$collection = $db->user;

//Extract the data that was sent to the server
$firstname= filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname= filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$address= filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//check if any input field is empty for validation purposes
 if ($username != "" && $password != "") {
  $user = $collection->findOne(array('username' => $username));
}
//If user already exists
if (isset($user)) {
  header('Location: signup.php?signup=exists');
  exit();
} else {
//if user does not exist
$dataArray = [
    "firstname" => $firstname,
    "lastname" => $lastname,
    "address" => $address,
    "telephone" => $telephone,
    "email" => $email,
    "username" => $username,
    "password" => $password
 ];
 header('Location: signup.php?signup=success');
}
//Add the new user to the database
$insertResult = $collection->insertOne($dataArray);

//Echo result back to user

$mongoClient::close();
?>
