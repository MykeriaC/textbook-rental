<?php
    include("security.php");
?>
<html>
    <head>
        <title>Homepage</title>
    </head>
    <body>
        <h1>Welcome To Rent To Read</h1>
        <?php
                // if the user is logged in, 
                if(security_loggedIn()){
                    echo('<a style="text-decoration: none" href="rent.php">Rent A Textbook</a>');
                    echo('<br>');
                    echo('<a style="text-decoration: none" href="return.php">Return A Textbook</a>');
                    echo('<br>');
                    echo('<a style="text-decoration: none" href="update.php">Update Password</a>');
                    echo('<br>');   
                    // display the remove once you've coded it up to only let the user remove their account if they have returned their book
                    echo('<a style="text-decoration: none" href="remove.php">Remove Account</a>');
                    echo('<br>');  
                    echo('<a style="text-decoration: none" href="logout.php">Log Out</a>');
                    echo('<br>');
                }

                // else if the user is NOT logged in
                else {
                    echo('<br>');
                    echo('<a style="text-decoration: none" href="signup.php">Sign Up</a>');
                    echo('<br>');
                    echo('<a style="text-decoration: none" href="login.php">Login</a>');
                    echo('<br>');
                    
                }
            ?>
    </body>
</html>