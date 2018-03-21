<?php

namespace Yansongda\GitNotify;

use Pimple\Container;
use Yansongda\Supports\Config;

class GitNotify extends Container
{
    /**
     * @var array
     */
    protected $providers = [
        ServiceProviders\KernelServiceProvider::class,
        ServiceProviders\SourceServiceProvider::class,
        ServiceProviders\DestinationServiceProvider::class,
    ];
    
    /**
     * [__construct description].
     *
     * @author yansongda <me@yansongda.cn>
     */
    public function __construct(array $config = [])
    {
        parent::__construct();

        $this['config'] = new Config($config);
        $this->registerProviders();
    }

    /**
     * Register service providers.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @return $this
     */
    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }

        return $this;
    }

    /**
     * Magic get access.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @param string $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * Magic set access.
     *
     * @author yansongda <me@yansongda.cn>
     *  
     * @param string $id
     * @param mixed  $value
     */
    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }
}
