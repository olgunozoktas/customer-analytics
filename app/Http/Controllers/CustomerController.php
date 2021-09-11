<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function data()
    {
        return Customer::with('department')->orderBy('created_at','desc')->get();
    }

    /**
     * @param CustomerStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CustomerStoreRequest $request)
    {
        /**
         * Since the request data already validated, we can get the ones we need
         */
        $data = $request->except(['_token','id']);

        if(Customer::create($data)) {
            return response()->json([
                'response' => 'success',
                'message' => 'Müşteri Kaydı Başarıyla Oluşturuldu'
            ]);
        }

        return response()->json([
            'response' => 'error',
            'message' => 'Müşteri Kaydı Oluşturulurken Hata Meydana Geldi'
        ]);
    }
}
