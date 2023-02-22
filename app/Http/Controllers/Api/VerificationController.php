<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Verification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificationController extends Controller
{
    public function index()
    {
        $objs = Verification::where('updated_at', '>', Carbon::now()->subSeconds(15)->toDateTimeString())
            ->orderBy('id', 'asc')
            ->get(['username', 'code'])
            ->toArray();

        return response()->json([
            'status' => 1,
            'data' => $objs
        ], Response::HTTP_OK);
    }
}
