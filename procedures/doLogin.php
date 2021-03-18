<?php
require_once __DIR__ . '/../inc/bootstrap.php';

// Gets the user by the username from the login
$user = findUserByUsername(request()->get('username'));

// Checks if the username was not found it directs back to the login page
if (empty($user)) {
    $session->getFlashBag()->add('error', 'Username was not found');
    redirect('../login.php');
}

// Checks to see if the passwords match using password_verify.
if (!password_verify(request()->get('password'), $user['password'])) {
    $session->getFlashBag()->add('error', 'Invalid Password');
    redirect('../login.php');
}

// If the 2 if statements passed. Logs in the user
saverUserSession($user);
redirect('../index.php');