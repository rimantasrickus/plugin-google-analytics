<?php // strict

namespace GoogleAnalytics\Middlewares;

use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
use Plenty\Plugin\Http\Request;
use Plenty\Plugin\Http\Response;

class GoogleAnalyticsMiddleware extends \Plenty\Plugin\Middleware
{
    public function before(Request $request)
    {
    }

    public function after(Request $request, Response $response):Response
    {
        /** @var FrontendSessionStorageFactoryContract $sessionStorage */
        $sessionStorage = pluginApp(FrontendSessionStorageFactoryContract::class);
        $sessionStorage->getPlugin()->unsetKey('GA_TRACK_ORDER');

        return $response;
    }
}