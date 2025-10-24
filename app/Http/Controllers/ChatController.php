<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        $prompt = $request->input('prompt');

        try {
            $apiKey = config('services.openai.key') ?? env('OPENAI_API_KEY');
            if (empty($apiKey)) {
                return response()->json(['message' => 'OpenAI API key not configured'], 500);
            }

            $resp = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens' => 800,
            ]);

            if ($resp->failed()) {
                // log server response for debugging
                Log::error('OpenAI API failure', [
                    'status' => $resp->status(),
                    'body' => $resp->body(),
                ]);

                return response()->json([
                    'message' => 'OpenAI API error',
                    'details' => $resp->json(),
                ], 500);
            }

            $json = $resp->json();
            $answer = $json['choices'][0]['message']['content'] ?? null;

            if (!$answer) {
                Log::warning('OpenAI returned no content', ['resp' => $json]);
                return response()->json(['message' => 'No response from OpenAI', 'raw' => $json], 500);
            }

            return response()->json(['response' => $answer]);
        } catch (Exception $e) {
            Log::error('ChatController exception: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['message' => 'Server error', 'error' => $e->getMessage()], 500);
        }
    }
}
