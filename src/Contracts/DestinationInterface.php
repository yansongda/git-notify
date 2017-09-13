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
    public function send();

    /**
     * template
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @param Closure|null $template
     */
    public function setTemplate(Closure $template = null);
}
