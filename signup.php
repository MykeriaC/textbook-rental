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
            body {
                text-align: center;
                justify-content: center;
            }
            button, .send {
                background-color: #ffaf42; /* Green */
                border: none;
                border-radius: 30px;
                color: white;
                padding: 8px 14px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 12px;
            }
        </style>  
    </head>
    <body>
        <?php
            echo("<ul>");
            // echo("<li><a style='text-decoration: none' href='update.php'>Update Password  </a></li>");
            // echo("<li><a style='text-decoration: none' href='remove.php'> Remove Account  </a></li>");
            // echo("<li><a style='text-decoration: none' href='rent.php'> Rent A Textbook  </a></li>");
            // echo("<li><a style='text-decoration: none' href='return.php'> Return A Textbook  </a></li>");
            echo("<li style='float:right'><a class='active' style='text-decoration: none' href='index.php'>Home</a></li>");
            echo("</ul>");
        ?>
        <h1>Create An Account</h1>
        <?php
            // if person is not logged in, this form should show up!
            if(!security_loggedIn()){

                if (security_submit()){
                    // echo("You're signed up! Please log in.");
                    // echo("<br>");
                    // echo("<a style='text-decoration: none' href='login.php'>Log In</a>");

                    // adds the user to the database
                    security_addNewUser();

                    // put this in a security function so that you're not calling post right here etc: function security_userPass(){ $user = $_POST["username"]; return $user; } then in here do $user = security_userPass() to pass the value to a variable and do an acho to confirm the value has been passed like echo($user)
                    $user = $_POST["username"];

                    // once the user submits their info, this will pass the value of their username to to session
                    $_SESSION["username"] = $user;
                }
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
                    <input class="send" type="submit" value="submit" name="submit"/>
                </form>
        <?php
                echo("<p>Already a user? <a style='text-decoration: none' href='login.php'><button>Log In Now</button></a></p>");
            }
            // else if the user is logged In
                else {
                // display index page
                echo("You are already logged into an account! You need to log out before signing up for a different account.");
                echo("<br>");
                echo("<a style='text-decoration: none' href='logout.php'><button>Log Out</button></a>");
            }
        ?>
    </body>
</html>