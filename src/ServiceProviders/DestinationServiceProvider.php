<?php

namespace Yansongda\GitNotify\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class DestinationServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['destination'] = function ($pimple) {
            $gateway = 'Yansongda\\GitNotify\\Gateways\\Destinations\\'.ucfirst($pimple['request']->query->get('to')).'Gateway';

            if (class_exists($gateway)) {
                return new $gateway($pimple);
            }

            throw new InvalidArgumentException('Destination Gateway ['.$pimple['request']->query->get('to').'] is not supported.');
        };
    }
}
