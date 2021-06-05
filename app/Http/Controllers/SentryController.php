<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SentryController extends Controller
{
    /**
     * send sentry message to slack
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $request = $request->json()->all();

        Log::info(json_encode($request));

        $slackWebhook = config('services.slack.webhook_url');

        $message = [
            'blocks' => [
                [
                    'type' => 'header',
                    'text' => [
                        'type' => 'plain_text',
                        'text' => data_get($request, 'event.title'),
                        'emoji' => true
                    ]
                ],
                [
                    'type' => 'section',
                    'fields' => [
                        [
                            'type' => 'mrkdwn',
                            'text' => "*Project:*\\n" . data_get($request, 'project')
                        ],
                        [
                            'type' => 'mrkdwn',
                            'text' => "*Link:*\\n<" . data_get($request, 'url') . "|sentry>"
                        ]
                    ]
                ],
                [
                    'type' => 'section',
                    'fields' => [
                        [
                            'type' => 'mrkdwn',
                            'text' => "*Environment:*\\n" . data_get($request, 'event.environment')
                        ]
                    ]
                ]
            ]
        ];

        Log::info(json_encode($message));

        Http::post($slackWebhook, $message);

        return response()->json(['message' => 'ok']);
    }

    /**
     * test sentry exception
     *
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function test(): JsonResponse
    {
        throw new Exception('test');
    }
}
