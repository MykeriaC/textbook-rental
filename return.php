<?php
    include("security.php");
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
    </body>
</html>