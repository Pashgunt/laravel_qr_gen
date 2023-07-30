<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\CompanyTableHash;
use App\Models\Feedback as ModelsFeedback;
use App\Models\FunnelTypes;
use App\Models\QrCode;
use App\Models\QrLink;
use App\Models\QrPdf;
use App\QR\Contracts\Feedback;
use App\QR\Repositories\CompanyRepository;
use App\QR\Repositories\CompanyTableHashRepository;
use App\QR\Repositories\FunnelTypesRepository;
use App\QR\Repositories\LocationFeedbackRepository;
use App\QR\Repositories\QrCodeRepository;
use App\QR\Repositories\QrLinkRepository;
use App\QR\Repositories\QrPdfRepository;
use App\QR\Services\LocationFeedback;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Feedback::class, function () {
            return new LocationFeedback();
        });

        $this->app->singleton(CompanyRepository::class, function ($app) {
            return new CompanyRepository(new Company());
        });

        $this->app->singleton(CompanyTableHashRepository::class, function ($app) {
            return new CompanyTableHashRepository(new CompanyTableHash());
        });

        $this->app->singleton(FunnelTypesRepository::class, function ($app) {
            return new FunnelTypesRepository(new FunnelTypes());
        });

        $this->app->singleton(LocationFeedbackRepository::class, function ($app) {
            return new LocationFeedbackRepository(new ModelsFeedback());
        });

        $this->app->singleton(QrCodeRepository::class, function ($app) {
            return new QrCodeRepository(new QrCode());
        });

        $this->app->singleton(QrLinkRepository::class, function ($app) {
            return new QrLinkRepository(new QrLink());
        });

        $this->app->singleton(QrPdfRepository::class, function ($app) {
            return new QrPdfRepository(new QrPdf());
        });
    }

    public function boot(): void
    {
    }
}
