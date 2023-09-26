<?php
session_start();

// Step 3: Check if the user is logged in
if (isset($_SESSION['user_name'])) {
    
    // If the user is logged in, print their name
    
    echo "Welcome, " . $_SESSION['user_name'] . " (ID: " . $_SESSION['user_id'] . ")!<br>";
    
    // Print the logout button
    echo "<form method='post'>";
    echo "<input type='submit' name='logout' value='Log out'>";
    echo "</form>";

    echo "<form method='post'>";
    echo "<input type='submit' name='dash' value='Dashboard'>";
    echo "</form>";
} else {
    // If the user is not logged in, print "Welcome Guest"
    echo "Welcome Guest";
}

if (isset($_POST['dash'])) {
    header("Location: dashboard.php");
    
}

// Step 4: Destroy the session when the user logs out
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.html");
    
}
?>
<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="index.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog</title>
    </head>
    <body>
        <div id="header">
            <h2>Apex Legends</h2>
            <a href="register.html"><button id="registerButton">Register</button></a>
            <a href="login.html"><button id="loginButton">Log In</button></a>
            
        </div>

        <div class="sections">
            <div id="leftSection">
                <div class="card">
                    <h2>New Event</h2>
                    <h5>Check out all the new skins and the new heirloom March 14, 2023</h5>
                    <img src="Images/event.png">
                    <p>Imperial Guard Collection</p>
                    <p>The Imperial Guard Collection is a set of 24 cosmetics exclusive to the event. The collection cosmetics could be obtained by
                        purchasing event-exclusive Imperial Guard collection packs for Apex Coins 700 which will give out one collection cosmetic and two cosmetics from the normal loot table.
                        Unlocking using Crafting Metals 1,200 for Legendary items and Crafting Metals 400 for Epic items.
                        By direct purchase from the Store: Apex Coins 1,800 for Legendary items and Apex Coins 1,000 for Epics.</p>
                </div>

                <div class="card">
                    <h2>New Update</h2>
                    <h5>Look at the all new system for all Apex Legends March 15, 2023</h5>
                    <img src="Images/update.jpg">
                    <p>Remastered Legend Classes</p>
                    <p>Rather than adding a new Legend this season, we're revamping the Legend Classes—bringing 
                    a new element to the Legends you know.The Legend Class system divides our Legends into 5 classes. 
                    Each class reflects a core playstyle that encourages similar patterns of engagement on the battlefield. 
                    We also wanted to give every Class its own strategic gameplay ability. Each of our current and future Legends 
                    now have a meaningful role benefitting the team they're on.</p>
                </div>

            </div>

            <div class="rightSection">
                <div class="card">
                    <h2>About Me</h2>
                    <img id="me" src="Images/frog.jpg">
                    <p>Apex ranked demon</p>
                </div>
        
                <div id="cardimages">
                    <h3>Popular Posts</h3>
                    <img class="banner" src="Images/1.jpg">
                    <img class="banner" src="Images/2.jpg">
                    <img class="banner" src="Images/3.jpg">
                </div>
        
                <div class="card">
                    <h3>Follow Me</h3>
                    <p>:D</p>
                </div>
            </div>
        </div>

        <div class="footer">
            <img id="footerimg" src="Images/footer.jpg">
        </div>
        
        <?php 
            $host = 'localhost';
            $dbname = 'register';
            $username = 'root';
            $password = '';
            
            // Connect to the database
            $conn = mysqli_connect($host, $username, $password, $dbname);
            
            // Retrieve the blog posts from the database
            $sql = "SELECT * FROM user_posts";
            $result = mysqli_query($conn, $sql);
            
            // Display the blog posts
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $title = $row['input_title'];
                    $content = $row['input_text'];
                    $postId = $row['post_id'];
                    $userId = $row['user_blogid'];
                    
                    // Output the blog post details
                    echo "<h2>$title</h2>";
                    echo "<p>$content</p>";
                
                    // Check if the session user's ID matches the blog post user ID
                    if ($userId == $_SESSION['user_id']) {
                        // Display the edit button
                        echo "<button id='editbutton' onclick='redirectToUpdatePost($postId)'>Edit</button>";
                    }
                        
                    echo "<hr>";
                }
            } else {
                // No blog posts found
                echo "No blog posts found.";
            }
        ?>
        
        <script>
            function redirectToUpdatePost(postId) {
            // Redirect the user to the updatepost.php page with the post ID as a parameter.
            window.location.href = "updatepost.php?post_id=" + postId;
        }
        </script>
        
    </body>
</html>
        
    


