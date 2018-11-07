<?php // strict

namespace GoogleAnalytics\Providers;

use GoogleAnalytics\Middlewares\GoogleAnalyticsMiddleware;
use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
use Plenty\Modules\Order\Events\OrderCreated;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;

/**
 * Class IOServiceProvider
 * @package IO\Providers
 */
class GoogleAnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Register the core functions
     */
    public function register()
    {
        $this->addGlobalMiddleware(GoogleAnalyticsMiddleware::class);
    }

    /**
     * boot twig extensions and services
     * @param Twig $twig
     * @param Dispatcher $dispatcher
     */
    public function boot(Twig $twig, Dispatcher $dispatcher)
    {
        $dispatcher->listen(OrderCreated::class, function($event)
        {
            /** @var FrontendSessionStorageFactoryContract $sessionStorage */
            $sessionStorage = pluginApp(FrontendSessionStorageFactoryContract::class);
            $sessionStorage->getPlugin()->setValue('GA_TRACK_ORDER', 1);
        }, 0);
    }
}
