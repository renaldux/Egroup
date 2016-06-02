<?php namespace Egroup\Database;

use Egroup\Contracts\DatabaseConnectionInterface;
use Egroup\Exceptions\EmptySQLQueryException;

class MySqlConnection implements DatabaseConnectionInterface
{
    /**
     * @var \PDO|null
     */
    protected $connection;

    public function connect()
    {
        $config = config('database');
        try {
            return $this->connection = new \PDO(
                "mysql:host=localhost;dbname={$config['dbname']};charset={$config['charset']}",
                $config['username'],
                $config['password'],
                []
            );
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * @return \PDO
     */
    private function getConnection()
    {
        if (null === $this->connection) {
            $this->connect();
        }
        return $this->connection;
    }

    /**
     * @param $sql
     * @param array $variables
     * @return \PDOStatement
     * @throws EmptySQLQueryException
     */
    private function executeQuery($sql, $variables = [])
    {
        if ( ! $sql) {
            throw new EmptySQLQueryException ('cant fetch empty sql');
        }

        $query = $this->getConnection()->prepare($sql);
        $query->execute($variables);
        return $query;
    }

    /**
     * @param $sql
     * @param array $variables
     * @return array
     * @throws \Exception
     */
    public function fetchAll($sql, $variables = [])
    {
        return $this->executeQuery($sql, $variables)->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * @param $sql
     * @param array $variables
     * @return mixed
     * @throws \Exception
     */
    public function fetchOne($sql, $variables = [])
    {
        return $this->executeQuery($sql, $variables)->fetch(\PDO::FETCH_OBJ);
    }

}