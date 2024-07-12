<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function __construct(private CustomerService $customerService)
    {
    }

    public function add(Request $request)
    {
        return $this->customerService->add($request->all());
    }

    public function all()
    {
        return $this->customerService->all();
    }

    public function show($ref)
    {
        return $this->customerService->show($ref);
    }

    public function update($ref, Request $request)
    {
        $input = $request->all();
        return $this->customerService->update($ref, $input);
    }

    public function delete($ref)
    {
        return $this->customerService->delete($ref);
    }
}
