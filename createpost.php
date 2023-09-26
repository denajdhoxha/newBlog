<?php 
$title = filter_input(INPUT_POST, 'title');
$content = filter_input(INPUT_POST, 'content');
?>

<form method="post" action="createpost.php">
  <label for="title">Title:</label>
  <input type="text" id="title" name="blog_title"><br><br>
  
  <label for="content">Content:</label><br>
  <textarea id="content" name="blog_content" rows="10" cols="50"></textarea><br><br>
  
  <input type="submit" value="Post Blog">
</form>

<button onclick="window.location.href='index.php'">Homepage</button>

<?php 
  $host = 'localhost';
  $dbname = 'register';
  $username = 'root';
  $password = '';
  
  $mysqli = new mysqli($host, $username, $password, $dbname);
  
  if ($mysqli->connect_errno) {
      die("Failed to connect to MySQL: " . $mysqli->connect_error);
  }
  echo "Connected successfully";

   // Handle form submission
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["blog_title"];
    $content = $_POST["blog_content"];
    
    // Retrieve the user ID
    session_start();
    $user_id = $_SESSION['user_id'];

    // Insert the data into the database
    $sql = "INSERT INTO user_posts (user_blogid, input_title, input_text) VALUES ('$user_id', '$title', '$content')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Posted";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
?>