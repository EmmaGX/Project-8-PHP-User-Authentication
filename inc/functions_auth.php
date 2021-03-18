<?php
// This function will read the session to see if the user is logged in
function isAuthenticated()
{
    // To call the session variable inside the function it
    // Needs to be a global variable
    global $session;

    return $session->get('auth_logged_in', false);
}

// Allows the user to log in automatically upon registration
function saverUserSession($user)
{
    global $session;

    $session->set('auth_logged_in', true);
    $session->set('auth_user_id', (int) $user['id']);

    $session->getFlashBag()->add('success', 'Successfully Logged In');
}