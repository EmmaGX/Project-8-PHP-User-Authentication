<?php
// This function will read the session to see if the user is logged in
function isAuthenticated()
{
    // To call the session variable inside the function it
    // Needs to be a global variable
    global $session;

    return $session->get('auth_logged_in', false);
}