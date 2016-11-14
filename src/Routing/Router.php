<?php

namespace Masterclass\Routing;

use Masterclass\Request\Request;

class Router
{
    protected $request;
    protected $routes = [];

    public function __construct(Request $request, $routes)
    {
        $this->request = $request;
        $this->routes = $routes;
    }

    public function determineControllers()
    {
        if ($this->request->server('REDIRECT_BASE')) {
            $redirectBase = $this->request->server('REDIRECT_BASE');
        } else {
            $redirectBase = '';
        }

        $ruri = $this->request->server('REQUEST_URI');
        $path = str_replace($redirectBase, '', $ruri);
        $return = array();

        foreach($this->routes as $k => $v) {
            $matches = array();
            $pattern = '$' . $k . '$';
            if(preg_match($pattern, $path, $matches))
            {
                $controller_details = $v;
                $controller_method = explode('/', $controller_details);
                $return = array('call' => $controller_method);
            }
        }

        return $return;
    }
}