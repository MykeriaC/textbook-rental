<?php
    include("security.php");
    session_start();
?>
<html>
    <head>
        <title>
            Return A Textbook
        </title>
    </head>
    <body>
        <?php
            echo("<a style='text-decoration: none' href='update.php'>Update Password | </a>");
            echo("<a style='text-decoration: none' href='remove.php'> Remove Account | </a>");
            echo("<a style='text-decoration: none' href='rent.php'> Rent A Textbook | </a>");
            echo("<a style='text-decoration: none' href='return.php'> Return A Textbook | </a>");
            echo("<a style='text-decoration: none' href='logout.php'>Log Out</a>");
        ?>
        <h1>Return A Textbook</h1>
        <?php
            // if user is not logged in, we want to notify them of that so that they may log so that they can return the book theyve rented
            if(!security_loggedIn()){
                echo("Seems you have not logged in yet! Please log in to return a book");
                echo("<br>");
                echo("<a style='text-decoration: none' href='login.php'>Go to Log In Page</a>");
            }
            // else if user is logged in
            else {
                $user = $_SESSION["username"];

                echo($user);
                echo("<br>");

                security_returnNeeded($user);
            }
        ?>
    </body>
</html>