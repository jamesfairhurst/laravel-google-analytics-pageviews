<?php

return [
    // Are pageviews tracked?
    'enabled' => env('PAGEVIEWS_ENABLED', true),
    // Site's tracking id
    'google_analytics_tracking_id' => env('PAGEVIEWS_GOOGLE_ANALYTICS_TRACKING_ID', ''),
    // Route name used internally to send pageview to google
    'route' => 'pageviews.store',
];
