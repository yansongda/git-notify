<?php

namespace Yansongda\GitNotify\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class KernelServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['request'] = Request::createFromGlobals();
    }
}
