<?php
    include("security.php");
    session_start();
?>
<html>
    <head>
        <title>
            Return A Textbook
        </title>
        <style>
            ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            }

            li {
            float: left;
            }

            li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            }

            li a:hover:not(.active) {
            background-color: #27285c;
            }

            .active {
            background-color: #ffaf42;
            }
            body {
                text-align: center;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <?php
            echo("<ul>");
            echo("<li><a style='text-decoration: none' href='update.php'>Update Password </a></li>");
            echo("<li><a style='text-decoration: none' href='remove.php'> Delete Account </a></li>");
            echo("<li><a style='text-decoration: none' href='rent.php'> Rent A Textbook </a></li>");
            echo("<li><a style='text-decoration: none' href='return.php'> Return A Textbook </a></li>");
            echo("<li style='float:right'><a class='active' style='text-decoration: none' href='logout.php'>Log Out</a></li>");
            echo("</ul>");
        ?>
        <h1>Return A Textbook</h1>
        <?php
            // if user is not logged in, we want to notify them of that so that they may log so that they can return the book theyve rented
            if(!security_loggedIn()){
                echo("Seems you have not logged in yet! Please log in to return a book");
                echo("<br>");
                echo("<a style='text-decoration: none' href='login.php'><button>Go to Log In Page</button></a>");
            }
            // else if user is logged in
            else {
                $user = $_SESSION["username"];

                security_returnNeeded($user);
            }
        ?>
    </body>
</html>