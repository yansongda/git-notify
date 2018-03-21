<?php

namespace Yansongda\GitNotify\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Yansongda\GitNotify\Exceptions\InvalidArgumentException;

class SourceServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['from'] = function ($pimple) {
            $gateway = 'Yansongda\\GitNotify\\Gateways\\Sources\\'.ucfirst($pimple['request']->query->get('from')).'Gateway';

            if (class_exists($gateway)) {
                return new $gateway($pimple);
            }

            throw new InvalidArgumentException('Source Gateway ['.$pimple['request']->query->get('from').'] is not supported.');
        };
    }
}
