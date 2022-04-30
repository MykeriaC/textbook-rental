<?php
    include("security.php");
?>
<html>
    <head>
        <title>
            Log Out
        </title>  
    </head>
    <body>
        <h1>Log Out</h1>
        <?php
                // security_loggedIn() checks whether or not a cookie exists; a cookie only exists once a user correctly logs in 
                // so if the user is not logged in, the cookie will not exist, therefore there will be no need to "log out" but if the cookie does exist, the user is logged in and there will be a need to log out
                if (security_loggedIn()){ 
                    security_logout();
                    echo("You have successfully logged out.");
                    echo("<br>");
                    echo("<p>Need to sign back in? <a style='text-decoration: none' href='index.php'>Sign In Again</a></p>");
                }
                // else if the user is not logged in
                else {
                    // link to index.php
                    echo("You are not logged into an account. Please log in to continue.");
                    echo("<br>");
                    echo("<a href='login.php'>Log In</a>");
                }
        ?>
    </body>
</html>