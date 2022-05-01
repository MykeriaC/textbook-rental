<?php
    include("security.php");
    session_start();
?>
<html>
    <head>
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
        <body>
            <?php
                echo("<ul>");
                echo("<li><a style='text-decoration: none' href='update.php'>Update Password </a></li>");
                echo("<li><a style='text-decoration: none' href='remove.php'> Remove Account </a></li>");
                echo("<li><a style='text-decoration: none' href='rent.php'> Rent A Textbook </a></li>");
                echo("<li><a style='text-decoration: none' href='return.php'> Return A Textbook </a></li>");
                echo("<li style='float:right'><a class='active' style='text-decoration: none' href='logout.php'>Log Out</a></li>");
                echo("</ul>");
                echo("<br>");

                // echo("checking in book ");

                $user = $_SESSION["username"];

                // echo($user);

                // call a function here called database_checkBookIn($user) that would pass in name of user and do "SELECT rented, checked_out FROM renters WHERE username='{$user}';" to retrieve those values from that table then fetch then change them both to where $row["rented"] = NULL and $row["checked_out"] = "no"
                security_checkBookIn($user); 
            ?>
        </body>  
    </head>
</html>
