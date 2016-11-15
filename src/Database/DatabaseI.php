<?php

namespace Masterclass\Database;

interface DatabaseI
{
    public function fetch($sql, $arguments);

    public function fetchAll($sql, $arguments);

    public function fetchColumn($sql, $arguments);

}