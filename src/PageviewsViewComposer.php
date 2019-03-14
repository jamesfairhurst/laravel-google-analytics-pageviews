<?php

namespace JamesFairhurst\LaravelGoogleAnalyticsPageviews;

use Illuminate\View\View;

class PageviewsViewComposer
{
    public function compose(View $view)
    {
        $config = config('pageviews');

        $enabled = $config['enabled'];
        $route = $config['route'];

        $payload = [
            '_token' => csrf_token(),
            // https://developers.google.com/analytics/devguides/collection/protocol/v1/parameters#dp
            'dp' => request()->getRequestUri(),
            // https://developers.google.com/analytics/devguides/collection/protocol/v1/parameters#dt
            'dt' => app('view')->yieldContent('title'),
            // https://developers.google.com/analytics/devguides/collection/protocol/v1/parameters#ua
            'ua' => request()->header('user-agent'),
            // https://developers.google.com/analytics/devguides/collection/protocol/v1/parameters#dr
            'dr' => url()->previous(),
        ];

        $query = http_build_query($payload);

        $view->with(compact(
            'enabled',
            'query',
            'route'
        ));
    }
}
