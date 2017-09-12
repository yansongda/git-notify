<?php

namespace Yansongda\GitNotify\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class DestinationServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['destination'] = function ($pimple) {
            if (!file_exists(dirname(dirname(__FILE__)) . '/Gateways/Destinations/' . ucfirst($pimple['request']->query->get('to')) . 'Gateway.php')) {
                throw new InvalidArgumentException("Gateway [" . $pimple['request']->query->get('to') . "] is not supported.");
            }

            $gateway = 'App\\Gateways\\Destinations\\'.ucfirst($pimple['request']->query->get('to')) . 'Gateway';

            return new $gateway($pimple);
        };
    }
}
