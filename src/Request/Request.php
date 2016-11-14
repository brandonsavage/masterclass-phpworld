<?php
/**
 * Created by PhpStorm.
 * User: brandon
 * Date: 11/14/16
 * Time: 10:52
 */

namespace Masterclass\Request;


class Request
{
    protected $get = [];
    protected $post = [];
    protected $session = [];
    protected $server;

    public function __construct(
        $get,
        $post,
        $session,
        $server)
    {
        $this->get = $get;
        $this->post = $post;
        $this->session = $session;
        $this->server = $server;
    }

    public function get($key, $default = null)
    {
        if ($key) {
            return $this->get[$key];
        }

        return $default;
    }

    public function post($key, $default = null)
    {
        if ($key) {
            return $this->post[$key];
        }

        return $default;
    }

    public function session($key, $default = null)
    {
        if ($key) {
            return $this->session[$key];
        }

        return $default;
    }

    public function server($key, $default = null)
    {
        if (isset($this->server[$key])) {
            return $this->server[$key];
        }

        return $default;
    }
}