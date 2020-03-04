<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';

//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->ecommerce;

//Select a collection
$collection = $db->user;

  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// if the input fields aren't empty
  if ($username != "" && $password != "") {
    $user = $collection->findOne(array('username' => $username, 'password' => $password));
  }
//If no User
  if (!isset($user)) {
    header('Location: login.php?login=nouser');
  }
//If User exists
  if (isset($user)) {
    session_start();
    $_SESSION['loggedInUser'] = $username;
    header('Location: details.php');
  }


?>
