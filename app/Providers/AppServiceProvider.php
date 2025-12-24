<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Document;
use App\Models\Report;
use App\Policies\DocumentPolicy;
use App\Policies\ReportPolicy;

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
        // Register policies
        Gate::policy(Document::class, DocumentPolicy::class);
        Gate::policy(Report::class, ReportPolicy::class);
    }
}
