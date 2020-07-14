<?php

require_once __DIR__ . '/../inc/bootstrap.php';

$user = new User(
    request()->request->getAlnum('username'),
    request()->request->getAlnum('password'),
);

if ($user->password !== request()->get('confirm_password')) {
    flashError('Registration Error');
    Response::redirectTo('/register.php');
}

if ($user->checkForDuplicatedUsername()) {
    flashError('User exists already.');
    Response::redirectTo('/login.php');
}

if ($newUser = $user->register()) {
    flashSuccess("New User $newUser[username] has been created.");
    Response::redirectTo('/', $regUser['uuid']);
}
