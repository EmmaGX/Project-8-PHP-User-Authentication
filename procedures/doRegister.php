<?php
require_once __DIR__ . '/../inc/bootstrap.php';

// Variables for the request object
$username = request()->get('username');
$password = request()->get('password');
$confirmPassword = request()->get('confirm_password');

// Starting checks before inserting the user into the database
// 1st Check is to see if the passwords were typed in the same
if ($password != $confirmPassword) {
    $session->getFlashBag()->add('error', 'Passwords do not match');
    redirect('../register.php');
}

// 2nd Check is to see if the user already exsists
if (!empty(findUserByUserName($username))) {
    $session->getFlashBag()->add('error', 'User already exists');
    redirect('../register.php');
}


// Creates a hashed password to be saved in the database
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Creates a user and adds a message and redirects to the home page
$user = createUser($username, $hashed);
saverUserSession($user);
$session->getFlashBag()->add('success', 'User added');
redirect('../index.php');
