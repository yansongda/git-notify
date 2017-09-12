<?php

namespace Yansongda\GitNotify\Contracts;

interface SourceInterface
{
    /**
     * get webhook event name.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @return string
     */
    public function getEventName();

    /**
     * get repository name.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @return string
     */
    public function getRepoName();

    /**
     * get repository describe.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @return string
     */
    public function getRepoDes();

    /**
     * get push reason.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @return string
     */
    public function getReason();
}
