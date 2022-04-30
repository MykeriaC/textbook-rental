<?php
    include("security.php");
    session_start();
?>
<html>
    <head>
        <title>
            Rent A Textbook
        </title>  
    </head>
    <body>
        <?php
            echo("<a style='text-decoration: none' href='update.php'>Update Password | </a>");
            echo("<a style='text-decoration: none' href='remove.php'> Remove Account | </a>");
            echo("<a style='text-decoration: none' href='rent.php'> Rent A Textbook | </a>");
            echo("<a style='text-decoration: none' href='return.php'> Return A Textbook | </a>");
            echo("<a style='text-decoration: none' href='logout.php'>Log Out</a>");
        ?>
        <h1>Rent A Textbook</h1>

        <?php
            if(security_loggedIn()){
        ?>  
                <form action="rent.php" method="POST" >      
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
                    <input type="submit" value="submit" name="submit"/>
                </form>

        <?php
                if (security_submit()){
                    // $rent = $_POST['books'];
                    // echo($rent);
                    // echo("no");

                    $user = $_SESSION["username"];

                    // echo($user);

                    security_rentBook($user);

                    // echo("hello");

                
                }    
            }
            // else if user is not logged in, it should say the user needs to log in to rent a book
            else {
                echo("Seems you have not logged in yet! Please log in to rent a book");
                echo("<br>");
                echo("<a style='text-decoration: none' href='login.php'>Go to Log In Page</a>");
            }
        ?>    
    </body>
</html>