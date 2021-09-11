<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;
use Nette\Utils\Random;

class Captcha
{
    static $cookieKey = 'captcha';

    /**
     * @return string
     */
    static function generate(): string
    {
        $captcha = Random::generate(5);
        setcookie(self::$cookieKey, $captcha);

        return $captcha;
    }

    /**
     * @param $captcha
     * @return bool
     */
    static function validate($captcha): bool
    {
        return $captcha == $_COOKIE[self::$cookieKey];
    }

    /**
     * @return JsonResponse
     */
    static function errorResponseAsJSON(): JsonResponse
    {
        return response()->json([
            'response' => 'error',
            'message' => 'Doğrulama Kodunu Yanlış Girdiniz'
        ]);
    }
}
