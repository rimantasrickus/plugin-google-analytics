<?php

namespace GoogleAnalytics\Providers;

use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
use Plenty\Plugin\Templates\Twig;

class TrackingCodeProvider
{
    public function call(Twig $twig)
    {
        /** @var FrontendSessionStorageFactoryContract $sessionStorage */
        $sessionStorage = pluginApp(FrontendSessionStorageFactoryContract::class);

        $logger = pluginApp(LoggerFactory::class)->getLogger('GoogleAnalytics', __METHOD__);
        $logger->error('before unset', [
            'plugin' => $sessionStorage->getPlugin()
        ]);

        $enableTracking = $sessionStorage->getPlugin()->getValue('GA_TRACK_ORDER') === 1;

        $sessionStorage->getPlugin()->unsetKey('GA_TRACK_ORDER');

        $logger->error('after unset', [
            'plugin' => $sessionStorage->getPlugin()
        ]);

        return $twig->render(
            'GoogleAnalytics::GoogleAnalyticsTrackingCode',
            [
                'trackOrder' => $enableTracking
            ]
        );
    }
}
