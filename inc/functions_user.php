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

// Finds the user by their id
function findUserById($userId)
{
    global $db;

    try {
        $query = "SELECT * FROM users WHERE id = :userId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $userId);
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

// Updates users password in the database
function updatePassword($password, $userId)
{
    global $db;

    try {
        $query = 'UPDATE users SET password = :password WHERE id = :userId';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (\Exception $e) {
        throw $e;
    }

    return true;
}