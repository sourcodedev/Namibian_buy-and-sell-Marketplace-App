<?php

require_once '../vendor/autoload.php';

session_start();

// init configuration
$clientID = '296391911422-8kfhsuur8fl153tihukaj4kfm8jamqhm.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'https://localhost/auth/welcome.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Connect to database
$hostname = "localhost";
$username = "root";
$password = "";
$database = "main";

$conn = mysqli_connect($hostname, $username, $password, $database);
