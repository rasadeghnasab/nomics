<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\GetCurrenciesRateRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Nomics\Facades\Nomics;

class NomicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function currencies(): JsonResponse
    {
        $currencies = Nomics::allCurrencies(['attributes' => 'id,name']);

        return response()->json($currencies);
    }

    public function currencyDetail(GetCurrenciesRateRequest $request): JsonResponse
    {
        $rate = Nomics::currencyDetail([
            'ids' => $request->get('ids'),
            'per-page' => $request->get('per-page', 1),
        ]);

        return response()->json($rate);
    }
}
