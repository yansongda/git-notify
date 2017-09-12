<?php

namespace Yansongda\GitNotify\ServiceProviders;

use GuzzleHttp\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class KernelServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['guzzle'] = new Client(['timeout' => 5.0]);

        $pimple['request'] = Request::createFromGlobals();
    }
}
