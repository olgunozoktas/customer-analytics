<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use App\Responses\CustomerStoreResponse;
use App\Utils\Captcha;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * @return Paginator
     */
    public function data()
    {
        return Customer::with('department')
            ->orderBy('created_at', 'desc')
            ->simplePaginate(5);
    }

    /**
     * All validations made through CustomerStoreRequest
     * @param CustomerStoreRequest $request
     * @return JsonResponse
     */
    public function store(CustomerStoreRequest $request)
    {
        if(!Captcha::validate($request->captcha)) {
            return Captcha::errorResponseAsJSON();
        }

        try {
            /**
             * Since the request data already validated, we can get the ones we need
             */
            $data = $request->except(['_token', 'id', 'captcha']);

            if (Customer::create($data)) {
                return CustomerStoreResponse::successfullyCreated();
            }
        } catch (\Exception $exception) {
            Log::alert("Müşteri Kaydı Oluştururken Hata Meydana Geldi: " . $exception->getMessage(), $request->all());
        }

        return CustomerStoreResponse::errorOccurredWhileCreating();
    }
}
