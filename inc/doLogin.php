<?php

require_once __DIR__ . '/../inc/bootstrap.php';

$user = new User(
    request()->request->getAlnum('username'),
    request()->request->getAlnum('password'),
);

if (!$user->checkForDuplicatedUsername()) {
    flashError('User not exist. Please sign up');
    Response::redirectTo('/register.php');
}

if ($regUser = $user->verify()) {
    flashSuccess("Welcome Back $regUser[username].");
    Response::redirectTo('/', $regUser['uuid']);
} else {
    flashError('Login error');
    Response::redirectTo('/login.php');
}
