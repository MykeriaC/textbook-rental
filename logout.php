<?php
    include("security.php");
?>
<html>
    <head>
        <title>
            Log Out
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
            echo("<li style='float:right'><a class='active' style='text-decoration: none' href='index.php'>Home</a></li>");
            echo("</ul>");
        ?>
        <h1>Log Out</h1>
        <?php
                // security_loggedIn() checks whether or not a cookie exists; a cookie only exists once a user correctly logs in 
                // so if the user is not logged in, the cookie will not exist, therefore there will be no need to "log out" but if the cookie does exist, the user is logged in and there will be a need to log out
                if (security_loggedIn()){ 
                    security_logout();
                    echo("You have successfully logged out.");
                    echo("<br>");
                    echo("<p>Need to sign back in? <a style='text-decoration: none' href='index.php'><button>Sign In Again</button></a></p>");
                }
                // else if the user is not logged in
                else {
                    // link to index.php
                    echo("You are not logged into an account. Please log in to continue.");
                    echo("<br>");
                    echo("<a style='text-decoration: none' href='login.php'><button>Log In</button></a>");
                }
        ?>
    </body>
</html>