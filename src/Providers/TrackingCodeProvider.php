<?php

namespace GoogleAnalytics\Providers;

use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Modules\Basket\Models\Basket;
use Plenty\Plugin\ConfigRepository;
use Plenty\Plugin\Templates\Twig;


class TrackingCodeProvider
{
    public function call(   Twig $twig,
                            ConfigRepository $configRepository,
                            BasketRepositoryContract $basketRepositoryContract,
                            $args)
    {
        return $twig->render('GoogleAnalytics::GoogleAnalyticsTrackingCode');
    }
}