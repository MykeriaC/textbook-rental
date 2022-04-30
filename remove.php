<?php
    include("security.php");
?>
<html>
    <head>
        <title>
            Remove Account
        </title>  
    </head>
    <body>
        <?php
            echo("<a style='text-decoration: none' href='update.php'>Update Password | </a>");
            echo("<a style='text-decoration: none' href='remove.php'> Remove Account | </a>");
            echo("<a style='text-decoration: none' href='rent.php'> Rent A Textbook | </a>");
            echo("<a style='text-decoration: none' href='return.php'> Return A Textbook | </a>");
            echo("<a style='text-decoration: none' href='index.php'>Home</a>");
        ?>
        <h1>Delete Account</h1>
        <?php
            // we want the remove to display whenever security_loggedIn == true (cookie exists/ person is logged in)
            if(security_loggedIn())
            {
        ?>
                <form action="remove.php" method="POST">
                    <label for="username">Username</label>
                    <input class="userPass" type="text" name="username" placeholder="Username">
                    <br>
                    <br>
                    <label for="password">Password</label>
                    <input class="userPass" type="password" name="password" placeholder="Password">
                    <br>
                    <br>
                    <input class="suButton" type="submit" value="submit" name="submit"/>
                </form>      
        <?php
                // this should help with the issue I had with when I go back to the sign up sheet from the login sheet without logging in, the code thinks Ive logged in 
                if (isset($_POST['submit'])){
                    security_deleteUser();
                }
            }
            // else if the user is not logged in
            else {
                // link to signup.php file
                echo("<a style='text-decoration: none; text-align: center; color: grey;' href='signup.php'>Home</a>"); 
            } 
        ?>
    </body>
</html>