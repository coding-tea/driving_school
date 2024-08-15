<?php

namespace App\Providers;

use App\Mixins\CollectionMixin;
use App\Services\ImageService;
use App\Services\UserManagement\CollaboratorService;
use App\Services\UserService;
use App\Uploads\ImageStorage;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindImageService();
        $this->bindUserService();
        $this->bindCollaboratorService();

    }


    public function bindImageService(): void
    {
        $this->app->singleton(ImageService::class, function (Application $app) {
            return new ImageService(new ImageStorage(new FilesystemManager($app)));
        });
    }

    public function bindUserService(): void
    {
        $this->app->singleton(UserService::class, function (Application $app) {
            return new UserService(app(ImageService::class));
        });
    }

    public function bindCollaboratorService(): void
    {

        $this->app->bind(CollaboratorService::class, function (Application $app) {
            return new CollaboratorService(app(ImageService::class), app(UserService::class));
        });
    }


    /**
     * Bootstrap any application services.
     * @throws \ReflectionException
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        $this->init();
        $this->app
            ->when(\Illuminate\Cache\RateLimiter::class)
            ->needs(\Illuminate\Contracts\Cache\Repository::class)
            ->give(function ($app) {
                return $app->make('cache')->store('memcached');
            });
    }


    /****
     * App Settings Initialisation
     * @return void
     * @throws \ReflectionException
     */
    private function init(): void
    {
        Carbon::setLocale($this->app->getLocale());

        date_default_timezone_set('Africa/Casablanca');
        Model::unguard();
        $this->mixins();
        $this->addBindDirective();
    }

    /****
     * Add App mixins/macros
     * @return void
     * @throws \ReflectionException
     */
    private function mixins(): void
    {
        Collection::mixin(new CollectionMixin);
    }

    /****
     * Add new blade directive
     * Bind component with model value
     * @return void
     */
    private function addBindDirective(): void
    {
        Blade::directive('bind', function ($bind = null) {
            return '<?php \App\View\FormDataBinder::bind(' . $bind . ') ?>';
        });
        Blade::directive('endBinding', function () {
            return '<?php \App\View\FormDataBinder::end() ?>';
        });
    }
}
