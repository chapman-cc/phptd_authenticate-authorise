<?php

use Firebase\JWT\JWT;

// class JWTplus extends JWT {
//     const ALG = "HS256";

//     public static function en () 
//     {
//         $payload = array (
//             "iss" => request()->getBaseUrl(),
//             "sub" => $userID, //get userID
//             "exp" => time() * 60 * 60,
//             "nbf" => time(),
//             "iat" => time()
//         );
//         $key = self::_getKey();
//         return self::encode($payload, $key, self::ALG);
//     }

//     public static function de ($jwt) 
//     {
//         $key = self::_getKey();
//         $decoded = self::decode($jwt, $key, [self::ALG]);
//         return $decoded->sub;
//     }

//     private static function _getKey() 
//     {
//         return ENV::GET('SECRET_KEY');
//     }
// }