<?php

namespace App\Http\Controllers;

use App\Services\SikerenStatistik;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/** Proxy JSON untuk tampilan (JS memanggil route ini, bukan SIKEREN langsung). */
class StatistikSikerenController extends Controller
{
    public function __invoke(Request $request, SikerenStatistik $statistik): JsonResponse
    {
        return response()->json($statistik->ambil((string) $request->query('periode', 'hari_ini')));
    }
}
