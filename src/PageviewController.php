<?php

namespace JamesFairhurst\LaravelGoogleAnalyticsPageviews;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class PageviewController extends BaseController
{
    public function store(Request $request)
    {
        if (! config('pageviews.enabled') || empty(config('pageviews.google_analytics_tracking_id'))) {
            return;
        }

        $client = new Client(['base_uri' => 'https://www.google-analytics.com/']);

        try {
            $response = $client->post('collect', [
                'query' => array_merge($request->only(['dp', 'dt', 'ua', 'dr']), [
                    'v' => '1',
                    't' => 'pageview',
                    'tid' => config('pageviews.google_analytics_tracking_id'),
                    'cid' => '555',
                    'dh' => config('app.url'),
                ]),
            ]);
        } catch (\Exception $e) {
            // This will only fire if something is really wrong at Google. The collect post above
            // won't throw an exception for any incorrect or missing data so verify the pageview
            // is being collected via the realtime dashboard.
            Log::error('PageviewController@store Google Analytics post collect error: '.$e->getMessage());
        }
    }
}
