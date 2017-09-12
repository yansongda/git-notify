<?php

namespace Yansongda\GitNotify\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Yansongda\Supports\Log;

class DestinationServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['destination'] = function ($pimple) {
            if (!file_exists(dirname(dirname(__FILE__)) . '/Gateways/Destinations/' . ucfirst($pimple['request']->query->get('to')) . 'Gateway.php')) {
                Log::error('InvalidArgumentException:', "Destination Gateway [" . $pimple['request']->query->get('to') . "] is not supported.");

                throw new InvalidArgumentException("Destination Gateway [" . $pimple['request']->query->get('to') . "] is not supported.");
            }

            $gateway = 'App\\Gateways\\Destinations\\'.ucfirst($pimple['request']->query->get('to')) . 'Gateway';

            return new $gateway($pimple);
        };
    }
}
