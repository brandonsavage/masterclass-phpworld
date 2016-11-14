<?php

class MasterController {
    
    private $config;
    private $db;
    
    public function __construct(
        \Masterclass\Request\Request $request,
        \Masterclass\Routing\Router $router,
        $config) {
        $this->request = $request;
        $this->config = $config;
        $this->router = $router;
    }
    
    public function execute() {
        $call = $this->router->determineControllers();
        $call_class = $call['call'];
        $class = ucfirst(array_shift($call_class));
        $method = array_shift($call_class);
        $this->createPDO();
        $o = 'Masterclass\Controller\\' . $class;
        $o = new $o($this->db, $this->request);
        return $o->$method();
    }

    protected function createPDO()
    {
        $dbconfig = $this->config['database'];
        $dsn = 'mysql:host=' . $dbconfig['host'] . ';dbname=' . $dbconfig['name'];
        $this->db = new PDO($dsn, $dbconfig['user'], $dbconfig['pass']);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
}