<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // format price with whitespaces
        Blade::directive('price', function ($exp) {
            return "<?php echo number_format((float)$exp, 0, ',', ' ') . ' грн.' ?>";
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->environment() !== 'production')
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);

        // add BugSnap
        $this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
        $this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);
    }
}
