<?php

namespace GoogleAnalytics\Providers;

use IO\Services\CustomerService;
use IO\Services\OrderService;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Modules\Basket\Models\Basket;
use Plenty\Modules\Frontend\Services\AccountService;
use Plenty\Plugin\ConfigRepository;
use Plenty\Plugin\Templates\Twig;


class TrackingCodeProvider
{
    public function call( Twig $twig, CustomerService $customerService )
    {

        return $twig->render('GoogleAnalytics::GoogleAnalyticsTrackingCode', ['data' => $customerService->getLatestOrder()]);
    }
}