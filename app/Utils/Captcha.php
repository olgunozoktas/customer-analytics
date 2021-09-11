<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Nette\Utils\Random;

class Captcha
{
    static $sessionKey = 'captcha';

    /**
     * @return string
     */
    static function generate(): string
    {
        $captcha = Random::generate(5);
        Session::put(self::$sessionKey, $captcha);

        return $captcha;
    }

    /**
     * @param $captcha
     * @return bool
     */
    static function validate($captcha): bool
    {
        return $captcha == Session::get(self::$sessionKey);
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
