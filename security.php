<?php
    include("database.php");

    function security_validate() {
        // Set a default value
        $status = false;
        
        // Validate
        if(isset($_POST["username"]) and isset($_POST["password"]) and isset($_POST["ucfID"])) {
            $status = true;
        }

        return $status;
    }

    function security_addNewUser() {
        // Validate and sanitize.
        $result = security_sanitize();
        // Open connection.
        database_connect();

        // Use connection.
        //
        // We want to make sure we don't add
        //  duplicate values.
        if(!database_verifyUser($result["username"], $result["password"])) {
            // Username does not exist.
            // Add a new one.
            database_addUser($result["username"], $result["password"], $result["ucfID"]);
        }
        
        // Close connection.
        database_close();
    }

    function security_sanitize() {
        // Create an array of keys username and password
        $result = [
            "username" => null,
            "password" => null,
            // "firstName" => null,
            // "lastName" => null,
            // "email" => null,
            "ucfID" => null
        ];

        if(security_validate()) {
            // After validation, sanitize text input.
            $result["username"] = htmlspecialchars($_POST["username"]);
            $result["password"] = htmlspecialchars($_POST["password"]);
            // $result["firstName"] = htmlspecialchars($_POST["firstName"]);
            // $result["lastName"] = htmlspecialchars($_POST["lastName"]);
            // $result["email"] = htmlspecialchars($_POST["email"]);
            $result["ucfID"] = htmlspecialchars($_POST["ucfID"]);
            // $result["newpassword"] = htmlspecialchars($_POST["newpassword"]);
        }

        // Return array
        return $result;
    }
?>