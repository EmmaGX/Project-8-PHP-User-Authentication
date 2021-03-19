<?php
require_once __DIR__ . '/../inc/bootstrap.php';
requireAuth();

// Gets the user entered data
$currentPassword = request()->get('current_password');
$newPassword = request()->get('password');
$confirmPassword = request()->get('confirm_password');

// Checks to see if thew passwords match
if ($newPassword != $confirmPassword) {
    $session->getFlashBag()->add('error', 'New passwords do not match. Please try again.');
    redirect('../account.php');
}

// Get the details of the logged in user
$user = getAuthenticatedUser();

// Verifies an existing user
if (empty($user)) {
    $session->getFlashBag()->add('error', 'Please try again');
    redirect('../account.php');
}

// Checks that the current password matched what is in the database
if (!password_verify($currentPassword, $user['password'])) {
    $session->getFlashBag()->add('error', 'Current password is incorrect. Please try again');
    redirect('../account.php');
}

// Hashed new password to be stored
$hashed = password_hash($newPassword, PASSWORD_DEFAULT);

// Checks if password was updated
if (!updatePassword($hashed, $user['id'])) {
    $session->getFlashBag()->add('error', 'Could not update password. Please try again');
    redirect('../account.php');
}

$session->getFlashBag()->add('success', 'Password updated');
redirect('../account.php');

