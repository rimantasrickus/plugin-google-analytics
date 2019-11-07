<?php // strict

namespace GoogleAnalytics\Providers;

use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
use Plenty\Modules\Order\Events\OrderCreated;
use Plenty\Modules\Webshop\Consent\Contracts\ConsentRepositoryContract;
use Plenty\Plugin\ConfigRepository;
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
        /** @var ConsentRepositoryContract $consentRepository */
        $consentRepository = pluginApp(ConsentRepositoryContract::class);

        /** @var ConfigRepository $config */
        $config = pluginApp(ConfigRepository::class);

        $consentRepository->registerConsent(
            'googleAnalytics',
            'GoogleAnalytics::GoogleAnalytics.consentLabel',
            [
                'description' => 'GoogleAnalytics::GoogleAnalytics.consentDescription',
                'provider' => 'GoogleAnalytics::GoogleAnalytics.consentProvider',
                'lifespan' => 'GoogleAnalytics::GoogleAnalytics.consentLifespan',
                'policyUrl' => 'GoogleAnalytics::GoogleAnalytics.consentPolicyUrl',
                'group' => $config->get('GoogleAnalytics.consentGroup', 'tracking'),
                'necessary' => $config->get('GoogleAnalytics.consentNecessary') === 'true',
                'isOptOut' => $config->get('GoogleAnalytics.consentOptOut') === 'true',
                'cookieNames' => ['_ga', '_gid', '_gat']
            ]
        );
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
