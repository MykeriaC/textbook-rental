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

    // // Accepts username, password, and new password
    // function database_updatePassword($username, $password, $newpassword){
    //     // Use the global connection
    //     global $connection;

    //     if($connection != null){
    //         // verifies that the username and password passed in exists in the database
    //         if (database_verifyUser($username, $password)){

    //             // updates password with new password
    //             // MAKE SURE THE PASSWORD IS A HASH BEFORE PASSING IT IN
    //             // Overwrite the existing new password value as a hash
    //             // $newpasswordHash = $_POST['newpassword'];
    //             $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
    //             mysqli_query($connection, "UPDATE renters 
    //             SET password='{$newpassword}' 
    //             WHERE username='{$username}';");
    //         }
    //     }
    // }

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
                // echo("row not null so it found data in the table where the book is already checked out");
                $status = true;
            }
        }

        // if status stays false when status returns, that means the book was not rented; if status true the book was rented

        return $status;
    }

    function database_rentBook($user){
        // Use the global connection
        global $connection;

        // whatever book the user selected to rent, the "value" from the form is passed into $rent (aka if To Kill A MB is selected, $rent would store "toKillAMockingbird")
        $rent = $_POST["books"];

        // echo(" database_rentBook username value:  ");
        // echo($user);


        // passes the value of rent into the database
        if($connection != null){

            // if the book this user is checking out isnt already checked out by someone else, you may procceed with the two mysqli queries and set $unrented to true to signify that the book is unrented
            // more: if database_alreadyRented() returns false, then we want to proceed with the two mysqli queries because we know the book wasnt already checked out
            if (!database_alreadyRented($rent)) {

            // adds the book that the user is checking out to rented colum of the table
            mysqli_query($connection, "UPDATE renters SET rented='{$rent}' WHERE username='{$user}';");

            // since the user has checked out a book at this point, the value of checked for the logged in user should change from no to yes
            mysqli_query($connection, "UPDATE renters SET checked_out='yes' WHERE username='{$user}';");

            echo("book was never checked out so this user has officially checked out that book");
            echo(" you have officially checked out " . $rent);
            
            }
            else {
                echo("book was already checked out by another user! so user cannot check this out! choose another book");
            }
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