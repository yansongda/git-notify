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
            if (!file_exists(dirname(dirname(__FILE__)) . '/Gateways/Sources/' . ucfirst($pimple['request']->query->get('from')) . 'Gateway.php')) {
                throw new InvalidArgumentException("Gateway [" . $pimple['request']->query->get('from') . "] is not supported.");
            }

            $gateway = 'App\\Gateways\\Sources\\'.ucfirst($pimple['request']->query->get('from')) . 'Gateway';

            return new $gateway($pimple);
        };
    }
}
