<?php
    include("security.php");
    session_start();
?>
<html>
    <head>
        <title>
            Rent A Textbook
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
            .bookNames {
                text-align: left;
                padding-left: 38%;
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
            echo("<li><a style='text-decoration: none' href='update.php'>Update Password </a></li>");
            echo("<li><a style='text-decoration: none' href='remove.php'> Delete Account </a></li>");
            echo("<li><a style='text-decoration: none' href='rent.php'> Rent A Textbook </a></li>");
            echo("<li><a style='text-decoration: none' href='return.php'> Return A Textbook </a></li>");
            echo("<li style='float:right'><a class='active' style='text-decoration: none' href='logout.php'>Log Out</a></li>");
            echo("</ul>");
        ?>
        <h1>Rent A Textbook</h1>

        <?php
            if(security_loggedIn()){
                if (security_submit()){

                    $user = $_SESSION["username"];
                    
                    security_rentBook($user);
                }   
        ?>  
                <form action="rent.php" method="POST">
                    <div class="bookNames">
                        <input type="radio" name="books" value="toKillAMockingbird"/>
                        <label for="toKillAMockingbird">To Kill A Mockingbird</label>
                        <br>
                        <br>
                        <input type="radio" name="books" value="theGreatGatsby"/>
                        <label for="theGreatGatsby">The Great Gatsby</label>
                        <br>
                        <br>
                        <input type="radio" name="books" value="mobyDick"/>
                        <label for="mobyDick">Moby Dick</label>
                        <br>
                        <br>
                    </div>
                    <input class="send" type="submit" value="submit" name="submit"/>
                </form>

        <?php
            }
            // else if user is not logged in, it should say the user needs to log in to rent a book
            else {
                echo("Seems you have not logged in yet! Please log in to rent a book");
                echo("<br>");
                echo("<a style='text-decoration: none' href='login.php'><button>Go to Log In Page</button></a>");
            }
        ?>    
    </body>
</html>