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

// This function will be used on pages for authentication
// And will use the isAuthenticated() from above
function requireAuth()
{
    if (!isAuthenticated()) {
        global $session;
        $session->getFlashBag()->add('error', 'Not Authorized');
        redirect('login.php');
    }
}

// Gets the authenticated users id
function getAuthenticatedUser()
{
    global $session;
    return findUserById($session->get('auth_user_id'));
}

// Checks if the logged in user is the owner of a task
function isOwner($ownerId)
{
    if (!isAuthenticated()) {
        return false;
    }
    global $session;
    return $ownerId == $session->get('auth_user_id');
}


