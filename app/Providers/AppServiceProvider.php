<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Formulaire de contact : trois plafonds cumulés.
        // Les clés doivent être différentes, sinon les compteurs se mélangent.
        RateLimiter::for('contact', fn (Request $request) => [
            Limit::perMinute(3)->by('contact-min:'.$request->ip()),
            Limit::perDay(20)->by('contact-day:'.$request->ip()),
            Limit::perHour(60)->by('contact-global'),
        ]);

        // Routes en lecture (projets) : freine les robots trop insistants.
        RateLimiter::for('reads', fn (Request $request) => Limit::perMinute(60)->by('reads:'.$request->ip()));
    }
}