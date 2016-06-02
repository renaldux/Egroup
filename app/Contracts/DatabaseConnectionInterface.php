<?php namespace Egroup\Contracts;

interface DatabaseConnectionInterface
{
    /**
     * @return connects to database
     */
    public function connect();

    /**
     * @param $sql
     * @param array $variables
     * @return array of objects
     * @throws \Exception
     */
    public function fetchAll($sql, $variables = []);

    /**
     * @param $sql
     * @param array $variables
     * @return object
     * @throws \Exception
     */
    public function fetchOne($sql, $variables = []);
    
}