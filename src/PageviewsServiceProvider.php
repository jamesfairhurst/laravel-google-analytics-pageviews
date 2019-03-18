<?php

namespace JamesFairhurst\LaravelGoogleAnalyticsPageviews;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PageviewsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/pageviews.php' => config_path('pageviews.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/pageviews'),
            ], 'views');
        }

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'pageviews');

        View::composer('pageviews::pageviewsSend', PageviewsViewComposer::class);

        Blade::directive('pageviews', function () {
            return "<?php echo view('pageviews::pageviewsSend'); ?>";
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/pageviews.php', 'pageviews');
    }
}
