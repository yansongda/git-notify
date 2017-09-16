<?php

namespace Yansongda\GitNotify\Contracts;

use Closure;

interface DestinationInterface
{
    /**
     * send msg.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @return mixed
     */
    public function apply();
}
