<?php
// Step 1: Establish a connection to the database
$host = 'localhost';
$dbname = 'register';
$usernamedb = 'root';
$passworddb = '';

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true); // Convert JSON to associative array

$username = $data['user_name'];
$password = $data['user_password'];

$mysqli = new mysqli($host, $usernamedb, $passworddb, $dbname);

// Check connection
if ($mysqli->connect_errno) {
  die("Failed to connect to MySQL: " . $mysqli->connect_error);
}
// Step 3: Validate login credentials against the database
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $mysqli->query($sql);

if(mysqli_num_rows($result) == 1) {
  $row = mysqli_fetch_assoc($result);
      // Retrieve the user ID
      $user_id = $row['id'];
  // Login successful
  session_start();
  $_SESSION['user_id']=$user_id;
  $_SESSION['user_name'] = $username;
  echo json_encode(array(
    'status' => true,
    'message' => "Success"
));
  
} else {
  // Login failed
  echo "Invalid username or password.";
}

?>




