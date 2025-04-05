<?php

namespace App\Providers;

use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') === 'production') {
            // Override TrustProxies hanya saat production
            app()->singleton(TrustProxies::class, function () {
                return new class('*', Request::HEADER_X_FORWARDED_ALL) extends TrustProxies {
                    public function __construct($proxies, $headers)
                    {
                        $this->proxies = $proxies;
                        $this->headers = $headers;
                    }
                };
            });

            // Optional: force Laravel to generate HTTPS URLs
            URL::forceScheme('https');
        }

        Blade::directive('currency', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });
    }
}
