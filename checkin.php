<?php
    include("security.php");

    session_start();

    echo("<a style='text-decoration: none' href='update.php'>Update Password | </a>");
    echo("<a style='text-decoration: none' href='remove.php'> Remove Account | </a>");
    echo("<a style='text-decoration: none' href='rent.php'> Rent A Textbook | </a>");
    echo("<a style='text-decoration: none' href='return.php'> Return A Textbook | </a>");
    echo("<a style='text-decoration: none' href='logout.php'>Log Out</a>");
    echo("<br>");

    // echo("checking in book ");

    $user = $_SESSION["username"];

    // echo($user);

    // call a function here called database_checkBookIn($user) that would pass in name of user and do "SELECT rented, checked_out FROM renters WHERE username='{$user}';" to retrieve those values from that table then fetch then change them both to where $row["rented"] = NULL and $row["checked_out"] = "no"
    security_checkBookIn($user); 
?>