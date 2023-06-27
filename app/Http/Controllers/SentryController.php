<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        $slackWebhook = config('services.slack.webhook_url');

        $title = data_get($request, 'event.title');

        $project = data_get($request, 'project');

        $url = data_get($request, 'url');

        $env = data_get($request, 'event.environment');

        $trace = data_get($request, 'event.stacktrace.frames');

        $contextString = json_encode(data_get($request, 'event.contexts'), JSON_PRETTY_PRINT);

        $lastTraceInApp = [];

        foreach ($trace as $step) {
            if ($step['in_app']) {
                $lastTraceInApp['function'] = $step['function'];
                $lastTraceInApp['filename'] = $step['filename'];
                $lastTraceInApp['lineno'] = $step['lineno'];
                $lastTraceInApp['context_line'] = $step['context_line'];

                break;
            }
        }

        $lastTraceString = json_encode($lastTraceInApp, JSON_PRETTY_PRINT);


        $message = [
            "embeds" => [
                [
                    "title" => "Sentry - $project",
                    "color" => 16711680,
                    "fields" => [
                        [
                            "name" => "Exception",
                            "value" => "[$title]($url)"
                        ],
                        [
                            "name" => "Environment",
                            "value" => $env
                        ],
                        [
                            "name" => "Stack Trace",
                            "value" => "
                            ```$lastTraceString```"
                        ],
                        [
                            "name" => "context",
                            "value" => "
                            ```$contextString```"
                        ]
                    ],
                    "footer" => [
                        "text" => "Error reported by Sentry",
                    ]
                ]
            ]
        ];

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
