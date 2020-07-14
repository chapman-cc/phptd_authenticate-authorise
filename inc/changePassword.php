<?php

require_once __DIR__ . "/../inc/bootstrap.php";

$regUser = User::getUserByUUID(cookie());
$confirmation = [
    'identical' => request()->request->getAlnum('password') === request()->request->getAlnum('confirm_password'),
    'verify' => password_verify(request()->request->getAlnum('current_password'), $regUser['password'])
];

if (!in_array(FALSE, $confirmation)) {
    $user = new User($regUser['username'], request()->request->getAlnum('password'));
    $updated = $user->updatePassword();

    flashSuccess("$updated[username] has successfully updated password.");
    Response::redirectTo('/');
}
