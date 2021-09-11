<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    public function data()
    {
        return Customer::with('department')->get();
    }

    public function store(CustomerStoreRequest $request)
    {
        dd($request->all());
    }
}
