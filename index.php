<?php
    include("security.php");
?>
<html>
    <head>
        <title>Homepage</title>
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
        <?php
            echo("<ul>");
            echo("<li style='float:right'><a class='active' style='text-decoration: none' href='index.php'>Home</a></li>");
            echo("</ul>");
        ?>
        <h1>Welcome To Rent To Read</h1>
        <?php
                // if the user is logged in, 
                if(security_loggedIn()){
                    echo('<a style="text-decoration: none" href="rent.php">Rent A Textbook</a>');
                    echo('<br>');
                    echo('<a style="text-decoration: none" href="return.php">Return A Textbook</a>');
                    echo('<br>');
                    echo('<a style="text-decoration: none" href="update.php">Update Password</a>');
                    echo('<br>');   
                    // display the remove once you've coded it up to only let the user remove their account if they have returned their book
                    echo('<a style="text-decoration: none" href="remove.php">Remove Account</a>');
                    echo('<br>');  
                    echo('<a style="text-decoration: none" href="logout.php">Log Out</a>');
                    echo('<br>');
                }

                // else if the user is NOT logged in
                else {
                    echo('<br>');
                    echo('<a style="text-decoration: none" href="signup.php"><button>Sign Up</button></a>');
                    echo('<br>');
                    echo('<a style="text-decoration: none" href="login.php"><button>Login</button></a>');
                    echo('<br>');
                    
                }
            ?>
    </body>
</html>