# Track Pageviews Server Side using Google Analytics

Don't want nasty tricksy Google Analytics JS tracking code on your site but still want to have some idea of pageviews? This package uses [Google's Measurement Protocol](https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide) to record basic pageviews on your site. It uses a small chunk of Javascript to post page data via Ajax on window load which will get sent to Google using Guzzle.

## Installation

You can install the package via composer:

```bash
composer require jamesfairhurst/laravel-google-analytics-pageviews
```

Optionally, you can publish the config file of the package.

```bash
php artisan vendor:publish --provider="JamesFairhurst\LaravelGoogleAnalyticsPageviews\PageviewsServiceProvider" --tag=config
```
  
## Usage

Add the Google Analytics Property Tracking ID to your `.env` file

```
PAGEVIEWS_GOOGLE_ANALYTICS_TRACKING_ID=UA-xxxxxxx-xx
```

Next, add the `@pageviews` blade directive to any page you wish to track or in a layouts file to track all pages e.g.

```php
    <script src="{{ mix('js/app.js') }}"></script>
    @pageviews
</body>
```

`@pageviews` will add a small chunk of Javascript that will send a `POST` `XMLHttpRequest` request on `window.load` to a package controller action that will record the pageview using [Google's Measurement Protocol](https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide#page).

```
window.addEventListener("load",function(e){var t=new XMLHttpRequest;t.open("POST","{{ route($route) }}",!0),t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send("dp=/home&dt=Home&ua=Mozilla/5.0&dr=https://example.com/home")});
```

You can also explicitly disable tracking by adding `PAGEVIEWS_ENABLED=false` to your `.env` file which is useful to stop tracking locally.
