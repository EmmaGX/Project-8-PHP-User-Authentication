<?php
require_once __DIR__ . '/../inc/bootstrap.php';

// To log out a user we need to remove all the authenticated sessions we created
// on doLogin.php

$session->remove('auth_logged_in');
$session->remove('auth_user_id');

$session->getFlashBag()->add('success', 'Successfully Logged Out');
redirect('../login.php');