<?php

$host = 'localhost';
$dbname = 'register';
$usernamedb = 'root';
$passworddb = '';

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true); // Convert JSON to associative array

$username = $data['user_name'];
$password = $data['user_password'];
$email = $data['user_email'];  

$mysqli = new mysqli($host, $usernamedb, $passworddb, $dbname);
    
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Insert the data into the database
$sql = sprintf(
    "INSERT INTO users (username, password, email) VALUES ('%s', '%s', '%s')",
    $username,
    $password,
    $email
  );

if ($mysqli->query($sql) === TRUE) {
    echo json_encode(array(
        'status' => true,
        'message' => "Success"
    ));
} else {
    echo json_encode("Error: " . $sql . "<br>" . $mysqli->error);
}

?>
