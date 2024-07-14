<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiKey;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('x-api-key')) {
            return response()->json(['message' => 'No API key'], 403);
        }

        $apiKey = $request->header('x-api-key');
        $apiKeyModel = ApiKey::where('key', $apiKey)->first();

        if (!$apiKeyModel) {
            return response()->json(['message' => 'Bad API key'], 403);
        }

        $request->merge(['user_id' => $apiKeyModel->user_id]);

        return $next($request);
    }
}
