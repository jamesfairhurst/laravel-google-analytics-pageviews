<?php

Route::namespace('JamesFairhurst\LaravelGoogleAnalyticsPageviews')->middleware('web')->group(function () {
    Route::post('pageviews', 'PageviewController@store')->name(config('pageviews.route'));
});
