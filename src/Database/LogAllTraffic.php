<?php

namespace Masterclass\Database;

class LogAllTraffic implements DatabaseI
{
    public function fetch($sql, $arguments)
    {
        $this->logger($sql, $arguments);
        return $this->database->fetch($sql, $arguments);
    }

    public function fetchAll($sql, $arguments)
    {

    }

    public function fetchColumn($sql, $arguments)
    {

    }
}