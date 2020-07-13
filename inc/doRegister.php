<?php

require_once __DIR__ . '/../inc/bootstrap.php';

$user = new USER(
    request()->request->getAlnum('username'),
    request()->request->getAlnum('password'),
);

if ($user->password !== request()->get('confirm_password')) {
    flashError('Registration Error');
    redirect('/register.php');
}

if ($user->checkForDuplicatedUsername()) {
    flashError('User exists already.');
    redirect('/login.php');
}

if ($newUser = $user->register()) {
    flashSuccess("New User " . $newUser["username"] . " has been created.");
    redirect('/login.php');
}
