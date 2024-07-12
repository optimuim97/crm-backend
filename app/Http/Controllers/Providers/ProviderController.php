<?php

namespace App\Http\Controllers\Providers;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Services\ProviderService;
use Illuminate\Http\Request;

class ProviderController extends Controller
{

    public function __construct(private ProviderService $providersService)
    {
    }

    public function add(Request $request)
    {
        return $this->providersService->add($request->all());
    }

    public function all()
    {
        return $this->providersService->all();
    }

    public function show($ref)
    {
        return $this->providersService->show($ref);
    }

    public function update($ref, Request $request)
    {
        $input = $request->all();
        return $this->providersService->update($ref, $input);
    }

    public function delete($ref)
    {
        return $this->providersService->delete($ref);
    }
}
