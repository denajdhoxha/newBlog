<?php
$host = 'localhost';
$dbname = 'register';
$username = 'root';
$password = '';

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Retrieve the post ID from the query string
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Retrieve the post details from the database
    $sql = "SELECT * FROM user_posts WHERE post_id = $post_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
        $title = $post['input_title'];
        $content = $post['input_text'];
    } else {
        // Post not found, handle the error
        echo "Post not found.";
        exit();
    }
} else {
    // Post ID not provided, handle the error
    echo "Post ID not provided.";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated post details
    $updatedTitle = $_POST["blog_title"];
    $updatedContent = $_POST["blog_content"];

    // Update the post in the database
    $sql = "UPDATE user_posts SET input_title = '$updatedTitle', input_text = '$updatedContent' WHERE post_id = $post_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Post updated successfully
        echo "Post updated successfully.";
    } else {
        // Error updating the post, handle the error
        echo "Error updating the post: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Post</title>
</head>
<body>
    <h1>Update Post</h1>
    <form method="POST" action="updatepost.php?post_id=<?php echo $post_id; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="blog_title" value="<?php echo $title; ?>"><br><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="blog_content" rows="10" cols="50"><?php echo $content; ?></textarea><br><br>

        <input type="submit" value="Update Post">
    </form>
    <button onclick="window.location.href='index.php'">Homepage</button>
</body>
</html>