<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\CompanyTableHash;
use App\Models\Feedback as ModelsFeedback;
use App\Models\FunneConfig;
use App\Models\FunneFields;
use App\Models\FunneLogic;
use App\Models\FunnelTypes;
use App\Models\QrCode;
use App\Models\QrLink;
use App\Models\QrPdf;
use App\Models\User;
use App\QR\Repositories\CompanyRepository;
use App\QR\Repositories\CompanyTableHashRepository;
use App\Qr\Repositories\FunnelConfigRepository;
use App\Qr\Repositories\FunnelFieldsRepository;
use App\Qr\Repositories\FunnelLogicRepository;
use App\QR\Repositories\FunnelTypesRepository;
use App\QR\Repositories\LocationFeedbackRepository;
use App\QR\Repositories\QrCodeRepository;
use App\QR\Repositories\QrLinkRepository;
use App\QR\Repositories\QrPdfRepository;
use App\Qr\Repositories\UserRepository;
use App\QR\Services\FeedbackService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
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

        $this->app->singleton(FunnelConfigRepository::class, function ($app) {
            return new FunnelConfigRepository(new FunneConfig());
        });

        $this->app->singleton(FunnelFieldsRepository::class, function ($app) {
            return new FunnelFieldsRepository(new FunneFields());
        });

        $this->app->singleton(FunnelLogicRepository::class, function ($app) {
            return new FunnelLogicRepository(new FunneLogic());
        });

        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository(new User());
        });
    }

    public function boot(): void
    {
    }
}
