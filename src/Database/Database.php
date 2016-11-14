<?php
/**
 * Created by PhpStorm.
 * User: brandon
 * Date: 11/14/16
 * Time: 11:07
 */

namespace Masterclass\Database;


class Database
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetch($sql, $arguments = [])
    {
        $stmt = $this->pdoPrepare($sql, $arguments);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAll($sql, $arguments = [])
    {
        $stmt = $this->pdoPrepare($sql, $arguments);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchColumn($sql, $arguments = [])
    {
        $stmt = $this->pdoPrepare($sql, $arguments);
        return $stmt->fetchColumn();
    }

    protected function pdoPrepare($sql, $arguments = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($arguments);
        return $stmt;
    }
}