<?php
    include("security.php");
?>
<html>
    <head>
        <title>
            Log In
        </title>
    <body>
            <!-- nav bar for sign up page should have login button -->
            <?php
                echo("<a style='text-decoration: none' href='update.php'>Update Password | </a>");
                echo("<a style='text-decoration: none' href='remove.php'> Remove Account | </a>");
                echo("<a style='text-decoration: none' href='rent.php'> Rent A Textbook | </a>");
                echo("<a style='text-decoration: none' href='return.php'> Return A Textbook | </a>");
                echo("<a style='text-decoration: none' href='logout.php'>Log Out</a>");
            ?>
            <h1>Welcome Back</h1>
            <?php
                if(!security_loggedIn()){
            ?>
                <form action="login.php" method="POST">
                    <input type="text" name="username" placeholder="Username">
                    <br>
                    <br>
                    <input type="password" name="password" placeholder="Password">
                    <br>
                    <br>
                    <input type="submit" value="Log In" name="submit"/>
                </form>

            <?php
                echo("<p>Need an account? <a style='text-decoration: none' href='signup.php'>Sign Up Now</a></p>");
                // while user is trying to log in, if they press the submit button, this happens
                if (security_submit()){
                    echo("logged in");
                    security_login();
                }
            }
                // else if user is not logged in
                else {
                    // display index page
                    echo("<a style='text-decoration: none' href='index.php'>Home</a>");
                }
                
            ?>
    </body>
</html>