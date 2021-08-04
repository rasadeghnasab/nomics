<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

        return response()->json($currencies->pluck('name', 'id'));
    }

    public function currencyRate(Request $request): JsonResponse
    {
        $rate = Nomics::currenciesTicker([
            'id' => $request->get('ids'),
            'per-page' => $request->get('per-page', 1),
        ]);

        return response()->json($rate);
    }
}
