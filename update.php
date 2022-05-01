<?php
    include("security.php");
?>
<html>
    <head>
        <title>
            Update Password
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
        <!-- if user is logged in, the navigation bar should display: the home page, remove account, rent a textbook, and return a textbook -->
        <?php
            echo("<ul>");
            echo("<li><a style='text-decoration: none' href='update.php'>Update Password </a></li>");
            echo("<li><a style='text-decoration: none' href='remove.php'> Delete Account </a></li>");
            echo("<li><a style='text-decoration: none' href='rent.php'> Rent A Textbook </a></li>");
            echo("<li><a style='text-decoration: none' href='return.php'> Return A Textbook </a></li>");
            echo("<li style='float:right'><a class='active' style='text-decoration: none' href='logout.php'>Log Out</a></li>");
            echo("</ul>");
        ?>
        <h1>Update Password</h1>
        <br>
        <?php
            // we want the update to display whenever security_loggedIn == true (cookie exists/ person is logged in)
            if(security_loggedIn())
            {
        ?>
                <form action="update.php" method="POST">
                    <!-- <label for="username">Username</label> -->
                    <input class="userPass" type="text" name="username" placeholder="Username">
                    <br>
                    <br>
                    <!-- <label for="password">Password</label> -->
                    <input class="userPass" type="password" name="password" placeholder="Password">
                    <br>
                    <br>
                    <!-- <label for="newpassword">New Password</label> -->
                    <input class="userPass" type="password" name="newpassword" placeholder="New Password">
                    <br>
                    <br>
                    <input type="submit" value="Apply Changes" name="submit"/>
                </form>
        <?php
                // this should help with the issue I had with when I go back to the sign up sheet from the login sheet without logging in, the code thinks Ive logged in 
                if (security_submit()){
                    security_updatePassword();
                }
            }
            // else if the user is not logged in
            else {
                // link to signup.php file
                echo("Seems you have not logged in yet! Please log in to update your password.");
                echo("<br>");
                echo("<a style='text-decoration: none' href='login.php'><button>Return to Log In</button></a>");
            } 
        ?>
    </body>
</html>