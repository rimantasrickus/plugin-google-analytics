<?php

namespace GoogleAnalytics\Providers;

use Plenty\Plugin\Templates\Twig;

class OptOutProvider
{
    public function call( Twig $twig )
    {

        return $twig->render('GoogleAnalytics::OptOut');
    }
}