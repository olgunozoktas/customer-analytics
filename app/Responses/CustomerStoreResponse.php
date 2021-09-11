<?php

namespace App\Responses;

use Illuminate\Http\JsonResponse;

class CustomerStoreResponse {

    /**
     * @return JsonResponse
     */
    static function successfullyCreated(): JsonResponse
    {
        return response()->json([
            'response' => 'success',
            'message' => 'Müşteri Kaydı Başarıyla Oluşturuldu'
        ]);
    }

    /**
     * @return JsonResponse
     */
    static function errorOccurredWhileCreating(): JsonResponse
    {
        return response()->json([
            'response' => 'error',
            'message' => 'Müşteri Kaydı Oluşturulurken Hata Meydana Geldi'
        ]);
    }
}
