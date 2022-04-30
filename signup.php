<?php
    include("security.php");

    // start my session to be able to store the user's username into a variable that can be accessed across the rent.php page
    session_start();
?>
<html>
    <head>
        <title>
            Sign Up
        </title>
    <body>
            <!-- nav bar for sign up page should have login button -->
            <?php
                echo("<a style='text-decoration' href='login.php'>Log In</a>");
            ?>

            <h1>Create An Account</h1>
            <?php
                // if person is not logged in, this form should show up!
                if(!security_loggedIn()){
            ?>
                    <form action="signup.php" method="POST">
                        <input type="text" name="firstName" placeholder="First Name">
                        <br>
                        <br>
                        <input type="text" name="lastName" placeholder="Last Name">
                        <br>
                        <br>
                        <input type="text" name="email" placeholder="Email">
                        <br>
                        <br>
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
                    echo("<p>Already a user? <a style='text-decoration' href='login.php'>Log In Now</a></p>");

                    if (security_submit()){
                        echo("signed in ");

                        // adds the user to the database
                        security_addNewUser();

                        // put this in a security function so that you're not calling post right here etc: function security_userPass(){ $user = $_POST["username"]; return $user; } then in here do $user = security_userPass() to pass the value to a variable and do an acho to confirm the value has been passed like echo($user)
                        $user = $_POST["username"];
                        // echo($user);

                        // once the user submits their info, this will pass the value of their username to to session
                        $_SESSION["username"] = $user;
                    }
                }
                // else if the user is Logged In
                 else {
                    // Display index.php
                    echo("<a style='text-decoration' href='index.php'>Home</a>");
                }
            ?>
    </body>
</html>