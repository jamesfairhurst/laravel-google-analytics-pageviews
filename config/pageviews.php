<?php

return [
    'enabled' => env('PAGEVIEWS_ENABLED', true),
    'google_analytics_tracking_id' => env('PAGEVIEWS_GOOGLE_ANALYTICS_TRACKING_ID', ''),
    'route' => 'pageviews.store',
];
