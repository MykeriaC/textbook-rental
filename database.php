<?php
    // Global connection
    $connection = null;

    function database_connect() {
        // Use the global connection
        global $connection;

        // Server
        $server = "localhost";
        // Username
        $username = "root";
        // If using XAMPP, 
        //  the password is an empty string.
        $password = "";
        // Database
        $database = "textbook";

        if($connection == null) {
            $connection = mysqli_connect($server, $username, $password, $database);
        }
    }

    function database_addUser($firstName, $lastName, $email, $ucfID , $username, $password) {
        // Use the global connection
        global $connection;

        // once a user creates their account, since at this point they have not checked out any books, it should immediately set checked to 'no' initially
        $checked = "no";

        if($connection != null) {
            // Overwrite the existing password value as a hash
            $password = password_hash($password, PASSWORD_DEFAULT);
            // Insert username and hashed password
            mysqli_query($connection, "INSERT INTO renters (username, password, first_name, last_name, ucf_id, email, checked_out) VALUES ('{$username}', '{$password}', '{$firstName}', '{$lastName}', '{$ucfID}', '{$email}', '{$checked}');");
        }
    }

    function database_deleteUser($username, $password){
        // Use the global connection
        global $connection;

        if($connection != null){
            // verifies that the user that we are trying to delete exists in the database first
            if (database_verifyUser($username, $password)){
                $results = mysqli_query($connection, "SELECT checked_out FROM renters WHERE username='{$username}';");

                $row = mysqli_fetch_assoc($results);
                // if a user has a checked out book, it shouldnt let you delete
                if($row["checked_out"] == "yes"){
                    echo("<p style='color:red;'><b>Error:</b> Unable to delete account. User still has a book checked out.");
                }
                // if the user doesnt have any checked out books, it should let you delete
                else {
                    // if the username and password passed in do exist, we are going to delete it from the table 'users'
                    mysqli_query($connection, "DELETE FROM renters WHERE username='{$username}';");

                    // logs the user out after their account is deleted
                    setcookie("login", "yes", time() - 10);
                }
            }
            else {
                echo("<p style='color:red;'><b>Error:</b> Unable to delete account. The username or password you have enetered is incorrect.");
            }
        }
    }

    // // Accepts username, password, and new password
    function database_updatePassword($username, $password, $newpassword){
        // Use the global connection
        global $connection;

        if($connection != null){
            // verifies that the username and password passed in exists in the database
            if (database_verifyUser($username, $password)){

                // updates password with new password
                // MAKE SURE THE PASSWORD IS A HASH BEFORE PASSING IT IN
                // Overwrite the existing new password value as a hash
                // $newpasswordHash = $_POST['newpassword'];
                $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
                mysqli_query($connection, "UPDATE renters 
                SET password='{$newpassword}' 
                WHERE username='{$username}';");
            }
        }
    }

    // function to specifically check if the book is already checked out
    function database_alreadyRented($rent){

        // Use the global connection
        global $connection;

        // echo(" database_alreadyRented: ");
        // echo($rent);

        $status = false;

        if($connection != null){
            // locates another row in the table where rented is equal to the book a user is trying to rent; if that book is not checked out, it returns null
            $results = mysqli_query($connection, "SELECT username FROM renters WHERE rented='{$rent}';");

            // mysqli_fetch_assoc() returns either null or row data
            $row = mysqli_fetch_assoc($results);

            // If $row is not null, it found row data where that book is already checked out so we want status to be true
            if($row != null) {
                $status = true;
            }
        }

        // if status stays false when status returns, that means the book was not rented; if status true the book was rented
        return $status;
    }

    // this function takes in the rented value of the name of the book (e.g.: theGreatGatsby) and returns the string version of it (The Great Gatsby)
    function database_returnTitle($rent){
        if ($rent == "toKillAMockingbird"){
            return $title = "To Kill A Mockingbird";
        }
        else if ($rent == "theGreatGatsby"){
            return $title = "The Great Gatsby";
        }
        else if ($rent == "mobyDick"){
            return $title = "Moby Dick";
        }
    }

    // checks whether or not the user attempting to rent a book already has one checked out
    function database_secondRent($user){
        // Use the global connection
        global $connection;

        $secondOne = false;

        if($connection != null){
            // finds the row in the table that matches $user and sees if that user has checked out a book already (aka if checked_out is yes or no)
            $results = mysqli_query($connection, "SELECT checked_out FROM renters WHERE username='{$user}';");

            // mysqli_fetch_assoc() returns either null or row data
            $row = mysqli_fetch_assoc($results);

            // if the current user has checked out a book already, 
            if($row["checked_out"] == "yes"){
                return $secondOne = true;
            }
        }

        return $secondOne;
    }

    function database_rentBook($user){
        // Use the global connection
        global $connection;

        // whatever book the user selected to rent, the "value" from the form is passed into $rent (aka if To Kill A MB is selected, $rent would store "toKillAMockingbird")
        $rent = $_POST["books"];

        // passes the value of rent into the database
        if($connection != null){

            // if the user doesnt have a an unreturned book rented
            if(!database_secondRent($user)){
                // if the book this user is checking out isnt already checked out by someone else, you may procceed with the two mysqli queries and set $unrented to true to signify that the book is unrented
                // more: if database_alreadyRented() returns false, then we want to proceed with the two mysqli queries because we know the book wasnt already checked out
                if (!database_alreadyRented($rent)) {

                // adds the book that the user is checking out to rented colum of the table
                mysqli_query($connection, "UPDATE renters SET rented='{$rent}' WHERE username='{$user}';");

                // since the user has checked out a book at this point, the value of checked for the logged in user should change from no to yes
                mysqli_query($connection, "UPDATE renters SET checked_out='yes' WHERE username='{$user}';");
                
                // we want to call another function that would pass in $rent and return the actual string name of the book
                $title = database_returnTitle($rent);
                echo("You have officially checked out " . $title. "!");
                
                }
                else {
                    echo("This book was already checked out by another user! Choose another book.");
                }
            }
            // else if the user has a book rented out that they did not return
            else {
                echo("<p style='color:red;'><b>Error:</b> You have already rented out a book! Return that one before attempting to rent a new one.</p>");
                echo("<a style='text-decoration: none' href='checkin.php'>Return A Book</a>");
            }
        }
    }

    // used in return.php to see if user has a book they need to return 
    function database_returnNeeded($user){
        // Use the global connection
        global $connection;

        // makes sure connection is there
        if($connection != null){
            // locates checked out from the rown that has the name of the passed in user
            $results = mysqli_query($connection, "SELECT checked_out, rented FROM renters WHERE username = '{$user}';");

            $row = mysqli_fetch_assoc($results);

            // if the row that was selected has no for checked_out, that means the user has not checked out any books and has no need to return anything
            if ($row["checked_out"] == "no"){
               echo("You have not checked out any books!");
               echo("<br>");
               echo("<a style='text-decoration: none' href='rent.php'><button>Rent A Book</button></a>");
            }
            // else if the row that was selected has yes for checked_out, that means the user has checked out books and will need to make a return (when they click on return, it should change the value of checked out from yes to no and the value of rented from the name of the book to NULL)
            else {
                echo("You have a book checked out!");
                echo("<br>");
                // name of rented book that the user has chosen (the one that needs to be returned )
                $title = database_returnTitle($row["rented"]);
                echo($title);
                echo("<br>");
                echo("<a style='text-decoration: none' href='checkin.php'><button>Return Book</button></a>");
            }
        }
    }

    // used in checkin.php to "return" a book which essentially sets rented back to NULL and checked_out to "no"
    function database_checkBookIn($user){
        // Use the global connection
        global $connection;

        if($connection != null){

            $results = mysqli_query($connection, "SELECT rented FROM renters WHERE username='{$user}';");

            $row = mysqli_fetch_assoc($results);

            $title = database_returnTitle($row["rented"]);

            echo("You have returned ". $title ."!");
            echo("<br>");
            echo("<a style='text-decoration: none' href='rent.php'><button>Rent Another Book</button></a>");

            // uses the value of $user passed into the parameter to locate the row that needs to have its rented and checked_out values changed
            mysqli_query($connection, "UPDATE renters SET rented = NULL, checked_out = 'no' WHERE username='{$user}';");

            // echo("values from checkBookIn function ");
            // if($row["rented"] == NULL){
            //     echo(" rented is NULL ");
            // }
            // echo($row["checked_out"]);
        }
    }

    function database_verifyUser($username, $password) {
        // Use the global connection
        global $connection;

        // Create a default value
        $status = false;

        if($connection != null) {
            // Use WHERE expressions to look for username
            $results = mysqli_query($connection, "SELECT password FROM renters WHERE username = '{$username}';");
            
            // mysqli_fetch_assoc() returns either null or row data
            $row = mysqli_fetch_assoc($results);
            
            // If $row is not null, it found row data.
            if($row != null) {
                // Verify password against saved hash
                if(password_verify($password, $row["password"])) {
                    $status = true;
                }
            }
        }

        return $status;
    }

    function database_close() {
        // user global connection
        global $connection;

        if($connection != null) {
            mysqli_close($connection);
        }
    }
?>