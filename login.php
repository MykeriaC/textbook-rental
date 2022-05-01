<?php
    include("security.php");
?>
<html>
    <head>
        <title>
            Log In
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
    <body>
            <!-- nav bar for sign up page should have login button -->
            <?php
                echo("<ul>");
                echo("<li><a style='text-decoration: none' href='update.php'>Update Password </a></li>");
                echo("<li><a style='text-decoration: none' href='remove.php'> Delete Account </a></li>");
                echo("<li><a style='text-decoration: none' href='rent.php'> Rent A Textbook </a></li>");
                echo("<li><a style='text-decoration: none' href='return.php'> Return A Textbook </a></li>");
                echo("<li style='float:right'><a class='active' style='text-decoration: none' href='logout.php'>Log Out</a></li>");
                echo("</ul>");
            ?>
            <h1>Welcome Back</h1>
            <?php
                if(!security_loggedIn()){

                    // while user is trying to log in, if they press the submit button, this happens
                    if (security_submit()){
                        // echo("logged in");
                        security_login();
                    }
            ?>
                <form action="login.php" method="POST">
                    <input type="text" name="username" placeholder="Username">
                    <br>
                    <br>
                    <input type="password" name="password" placeholder="Password">
                    <br>
                    <br>
                    <input class="send" type="submit" value="Log In" name="submit"/>
                </form>

            <?php
                echo("<p>Need an account? <a style='text-decoration: none' href='signup.php'><button>Sign Up Now</button></a></p>");
                }
                // else if user is logged in
                else {
                    // display index page
                    echo("You are already logged into an account! You need to log out before logging in as a different user.");
                    echo("<br>");
                    echo("<a style='text-decoration: none' href='logout.php'><button>Log Out</button></a>");
                }
                
            ?>
    </body>
</html>