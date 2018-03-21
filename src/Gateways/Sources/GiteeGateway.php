<?php

namespace Yansongda\GitNotify\Gateways\Sources;

use Pimple\Container;
use Yansongda\GitNotify\Contracts\SourceInterface;
use Yansongda\GitNotify\Exceptions\GatewayException;

class GiteeGateway implements SourceInterface
{
    /**
     * raw data.
     *
     * @var array
     */
    protected $raw;

    /**
     * app.
     *
     * @var Container
     */
    protected $app;

    /**
     * construct method.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @param string $raw
     */
    public function __construct(Container $app)
    {
        $this->raw = json_decode($app['request']->getContent(), true);

        if (is_null($this->raw)) {
            throw new GatewayException("data is null", 1);
        }

        $this->app = $app;
    }

    /**
     * get webhook event name.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @return string
     */
    public function getEventName()
    {
        $this->raw['eventName'] = $this->raw['hook_name'];

        return $this->raw['eventName'];
    }

    /**
     * get repository name.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @return string
     */
    public function getRepoName()
    {
        $this->raw['repoName'] = $this->raw['repository']['name'];
        
        return $this->raw['repoName'];
    }

    /**
     * get repository describe.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @return string
     */
    public function getRepoDes()
    {
        $this->raw['repoDes'] = $this->raw['repository']['description'];
        
        return $this->raw['repoDes'];
    }

    /**
     * get push reason.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @return string
     */
    public function getReason()
    {
        switch ($this->getEventName()) {
            case 'push_hooks':
                $reason = '代码修改 - ' . $this->raw['commits'][0]['message'];
                break;

            case 'tag_push_hooks':
                $reason = '版本发布 - 发布新版本 - ' . end(explode('/', $this->raw['ref']));
                break;

            default:
                # code...
                break;
        }

        return $reason;
    }

    /**
     * magic get.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @param string $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->raw[$id];
    }

    /**
     * magic set
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @param string  $id
     * @param mixed $value
     */
    public function __set($id, $value)
    {
        if ($id === 'password' && (!isset($this->raw['password']) || $this->raw['password'] != $value)) {
            throw new GatewayException("password not match", 2);
        }

        $this->raw[$id] = $value;
    }
}
