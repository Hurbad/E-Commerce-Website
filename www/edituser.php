
<?php
session_start();

	require __DIR__ . '/vendor/autoload.php';
	//Create instance of MongoDB client
	$mongoClient = (new MongoDB\Client);

	//Select a database
	$db = $mongoClient->ecommerce;


	//Extract the customer details
	$username= filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
	$lastname= filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
	$address= filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
	$email= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
	$telephone= filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

	//Criteria for finding document to replace
	$replaceCriteria = [
	    "_id" => new MongoDB\BSON\ObjectID($id)
	];
	//Data to replace
	$customerData = [
	    "firstname" => $firstname,
	    "lastname" => $lastname,
	    "address" => $address,
	    "email" => $email,
	    "telephone" => $telephone,
	    "username" => $username,
	    "password" => $password,
	];
	$_SESSION['loggedInUser'] = $username;
	//Replace customer data for this ID
	$updateRes = $db->user->replaceOne($replaceCriteria, $customerData);

	if($updateRes->getModifiedCount() == 1){
		header('Location: details.php?change=success');
		exit();
	}

?>
