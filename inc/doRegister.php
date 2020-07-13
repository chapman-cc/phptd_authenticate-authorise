<?php

// TODO: Allow new users to register for your application. Store the user's password as a hash.
require_once __DIR__ . '/../inc/bootstrap.php';

$back = '/register.php';

$user = new USER(
    request()->get('username'),
    request()->get('password')
);

if ($user->password !== request()->get('confirm_password')) {
    flashError('Registration Error');
    redirect($back);
}

if ($user->checkForDuplicatedUsername()) {
    flashError('User exists already.');
    redirect('/login.php');
}

$newUser = $user->register();
if ($newUser) {
    flashSuccess("New User " . $newUser["username"] . " has been created.");
    redirect('/login.php');
}
