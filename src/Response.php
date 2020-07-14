<?php

use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use Symfony\Component\HttpFoundation\Cookie as BaseCookie;

class Response extends BaseResponse
{
    public static function redirectTo($path, $jwt = null)
    {
        $response = self::create(null, self::HTTP_FOUND, ['Location' => $path]);
        if (!is_null($jwt)) {
            $response->headers->setcookie(self::_newCookie($jwt));
        }

        return $response->send();
    }

    private static function _newCookie($jwt)
    {
        return BaseCookie::create(
            "jwt",
            self::_newJWT($jwt),
            time() * ENV::GET('COOKIE_EXPIRE'),
            ENV::GET('COOKIE_PATH'),
            ENV::GET('COOKIE_DOMAIN'),
            null,
            TRUE
        );
    }
    private static function _newJWT($sub)
    {
        return JWT::encode(
            [
                "iss" => request()->getBaseUrl(),
                "sub" => $sub,
                "exp" => time() * 60 * 60,
                "nbf" => time(),
                "iat" => time(),
                // "auth_role" => $role
            ],
            ENV::GET('SECRET_KEY'),
            ENV::GET('ALG')
        );
    }
}
