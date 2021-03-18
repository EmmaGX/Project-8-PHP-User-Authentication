<?php

// This function will return an empty array if no username is found, or
// if a user is found an associative array of the users details from the
// database
function findUserByUserName($username)
{
    global $db;

    try {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch();
    } catch (\Exception $e) {
        throw $e;
    }
}


// This function creates the user
function createUser($username, $password)
{
    global $db;

    try {
        $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        // Uses the findUserByUsername function to return the user if the
        // user was created
        return findUserByUserName($username);
    } catch (\Exception $e) {
        throw $e;
    }
}