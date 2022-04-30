<?php
    include("database.php");

    function security_validate() {
        // Set a default value
        $status = false;
        
        // Validate
        if(isset($_POST["username"]) and isset($_POST["password"])) {
            $status = true;
        }

        return $status;
    }

    // this function is strictly to validate the other user info 
    function security_validateOtherInfo(){
        // Set a default value
        $status = false;
        
        // Validate
        if(isset($_POST["firstName"]) and isset($_POST["lastName"]) and isset($_POST["email"]) and isset($_POST["ucfID"])) {
            $status = true;
        }

        return $status;
    }

    function security_submit() {
        $status = false;

        if(isset($_POST["submit"])){
            $status = true;
        }

        return $status;
    }

    function security_login() {
        // Set a default value
        $status = false;
        // Validate and sanitize
        $result = security_sanitize();
        // Open connection
        database_connect();
        // Use the connection
        $status = database_verifyUser($result["username"], $result["password"]);
        // Close connection
        database_close();
        // Check status
        if($status) {
            // Set a cookie
            setcookie("login", "yes");
        }
    }

    function security_addNewUser() {
        // Validate and sanitize.
        $result = security_sanitize();
        $resultOthers = security_sanitizeOtherInfo();
        // Open connection.
        database_connect();

        // Use connection.
        //
        // We want to make sure we don't add
        //  duplicate values.
        if(!database_verifyUser($result["username"], $result["password"])) {
            database_addUser($resultOthers["firstName"], $resultOthers["lastName"], $resultOthers["email"], $resultOthers["ucfID"], $result["username"], $result["password"]);
        }
        
        // Close connection.
        database_close();
    }

    // function security_deleteUser(){
    //     // Validate and sanitize.
    //     $result = security_sanitize();

    //     // Open connection.
    //     database_connect();

    //     // Use connection.
    //     // 
    //     // The database_deleteUser() function already verifies that the username and password we are trying to delete exists in the database
    //     database_deleteUser($result["username"], $result["password"]);

    //     // Close connection
    //     database_close();
    // }

    // function security_updatePassword(){
    //     // Validate and sanitize username and password
    //     $result = security_sanitize();

    //     // Validate and sanitize new password
    //     $result2 = security_sanitizeNewPassword();

    //     // Open connection.
    //     database_connect();

    //     // Use connection
    //     // 
    //     // The database_updateUser() function already verifies that the username and password we are trying to delete exists in the database
    //     database_updatePassword($result["username"], $result["password"], $result2["newpassword"]);

    //     // Close connection
    //     database_connection();
    // }
    
    function security_rentBook($user){

        // Open connection.
        database_connect();

        // echo(" security func ");
        // echo($user);

        // calls function to add it to database
        database_rentBook($user);

        // Close connection
        database_connection();
    }

    function security_returnNeeded($user){
        // Open connection.
        database_connect();

        database_returnNeeded($user);

        // Close connection
        database_connection();
    }

    function security_checkBookIn($user){
        // Open connection.
        database_connect();

        database_checkBookIn($user);

        // Close connection
        database_connection();
    }

    function security_loggedIn() {
        // Does a cookie exist?
        return isset($_COOKIE["login"]);
    }

    function security_logout() {
        // Set a cookie to the past
        setcookie("login", "yes", time() - 10);
    }

    function security_sanitize() {
        
        // Create an array of keys username and password
        $result = [
            "username" => null,
            "password" => null,
        ];

        if(security_validate()) {
            // After validation, sanitize text input.
            $result["username"] = htmlspecialchars($_POST["username"]);
            $result["password"] = htmlspecialchars($_POST["password"]);
        }

        // Return array
        return $result;
    }

    // this function is strictly to sanitize the other user info
    function security_sanitizeOtherInfo(){
        // Create an array of keys newpassword
        $result = [
                "firstName" => null,
                "lastName" => null,
                "email" => null,
                "ucfID" => null
        ];

        if(security_validateOtherInfo()) {
                // After validation, sanitize text input.
                $result["firstName"] = htmlspecialchars($_POST["firstName"]);
                $result["lastName"] = htmlspecialchars($_POST["lastName"]);
                $result["email"] = htmlspecialchars($_POST["email"]);
                $result["ucfID"] = htmlspecialchars($_POST["ucfID"]);
        }
        
        // Return array
        return $result;
    }
?>