<?php
    include("security.php");
?>
<html>
    <head>
        <title>
            Sign Up
        </title>
    </head>
    <body>
        <h1>Sign Up</h1>
        <br>

        <form action="signup.php" method="POST">
<!-- 
            <input type="text" name="firstName" placeholder="First Name">
            <br>
            <br>
            <input type="text" name="lastName" placeholder="Last Name">
            <br>
            <br>
            <input type="text" name="email" placeholder="Email">
            <br>
            <br> -->
            <input type="text" name="ucfID" placeholder="UCF ID">
            <br>
            <br>
            <input type="text" name="username" placeholder="Username">
            <br>
            <br>
            <input type="password" name="password" placeholder="Password">
            <br>
            <br>
            <input type="submit" value="submit" name="submit"/>
        </form>

        <?php
            if(isset($_POST["submit"])){
                echo("hello");
                database_addNewUser();
                echo("bye");
            }
        ?>
    </body>
</html>