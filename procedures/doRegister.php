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