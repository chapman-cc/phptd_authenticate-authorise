<?php

require_once __DIR__ . "/../inc/bootstrap.php";

flashSuccess('Logged out, bye!');
Response::redirectTo('/', 'deleteCookie');
