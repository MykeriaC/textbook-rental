<?php
    include("security.php");
?>
<html>
    <head>
        <title>
            Remove Account
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
            echo("<li><a style='text-decoration: none' href='update.php'>Update Password  </a></li>");
            echo("<li><a style='text-decoration: none' href='remove.php'> Delete Account  </a></li>");
            echo("<li><a style='text-decoration: none' href='rent.php'> Rent A Textbook  </a></li>");
            echo("<li><a style='text-decoration: none' href='return.php'> Return A Textbook  </a></li>");
            echo("<li style='float:right'><a class='active' style='text-decoration: none' href='logout.php'>Log Out</a></li>");
            echo("</ul>");
        ?>
        <h1>Delete Account</h1>
        <?php
            // we want the remove to display whenever security_loggedIn == true (cookie exists/ person is logged in)
            if(security_loggedIn())
            {
                // this should help with the issue I had with when I go back to the sign up sheet from the login sheet without logging in, the code thinks Ive logged in 
                if (isset($_POST['submit'])){
                    security_deleteUser();
                }
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
                    <input class="send" type="submit" value="submit" name="submit"/>
                </form>      
        <?php
            }
            // else if the user is not logged in
            else {
                echo("Seems you have not logged in yet! Please log in to delete your account.");
                echo("<br>");
                echo("<a style='text-decoration: none;' href='login.php'><button>Go to Log In Page</button></a>"); 
            } 
        ?>
    </body>
</html>