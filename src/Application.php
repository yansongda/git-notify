<?php

namespace Yansongda\GitNotify;

use Pimple\Container;

class Application extends Container
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
    public function __construct()
    {
        parent::__construct();

        $this->registerProviders();
    }

    /**
     * Register service providers.
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
     * @param string $id
     * @param mixed  $value
     */
    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }
}
