<?php

require_once __DIR__ . '/../inc/bootstrap.php';

$user = new USER(
    request()->request->getAlnum('username'),
    request()->request->getAlnum('password'),
);

if (!$user->checkForDuplicatedUsername()) {
    flashError('User not exist. Please sign up');
    redirect('/register.php');
}

if ($regUser = $user->verify()) {
    flashSuccess("Welcome Back $regUser[username].");
    redirect('/');
} else {
    flashError('Login error');
    redirect('/login.php');
}
