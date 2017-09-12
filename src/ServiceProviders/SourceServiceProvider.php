<?php

namespace Yansongda\GitNotify\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Yansongda\Supports\Log;
use Yansongda\GitNotify\Exceptions\InvalidArgumentException;

class SourceServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['from'] = function ($pimple) {
            if (!file_exists(dirname(dirname(__FILE__)) . '/Gateways/Sources/' . ucfirst($pimple['request']->query->get('from')) . 'Gateway.php')) {
                Log::error('InvalidArgumentException:', "Source Gateway [" . $pimple['request']->query->get('to') . "] is not supported.");

                throw new InvalidArgumentException("Source Gateway [" . $pimple['request']->query->get('from') . "] is not supported.");
            }

            $gateway = 'App\\Gateways\\Sources\\'.ucfirst($pimple['request']->query->get('from')) . 'Gateway';

            return new $gateway($pimple);
        };
    }
}
