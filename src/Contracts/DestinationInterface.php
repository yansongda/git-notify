<?php

namespace Yansongda\GitNotify\Contracts;

interface DestinationInterface
{
    /**
     * send msg.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @return mixed
     */
    public function send();
}
