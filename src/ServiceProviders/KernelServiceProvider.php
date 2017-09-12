<?php

namespace Yansongda\GitNotify\ServiceProviders;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use GuzzleHttp\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class KernelServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['log'] = function () {
            $output = "%datetime% > %level_name% > %message% %context% %extra%\n\n";
            $formatter = new LineFormatter($output);

            $log = new Logger('notify');
            $handler = new StreamHandler(dirname(dirname(dirname(__FILE__))) . '/log/notify.log');
            $handler->setFormatter($formatter);
            $log->pushHandler($handler);

            return $log;
        };

        $pimple['guzzle'] = new Client(['timeout' => 5.0]);

        $pimple['request'] = Request::createFromGlobals();
    }
}
