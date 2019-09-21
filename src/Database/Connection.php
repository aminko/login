<?php

namespace Demo\Database;

use \PDO;
Use Demo\Base\Config;

class Connection {

    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    { 
        $config = Config::file('database');

        $dsn =  "mysql:host=".$config['host'].";dbname=".$config['dbname']; //TODO: check encoding issue
        $this->connection = new PDO($dsn, $config['username'], $config['password']);
        
        return $this;
    }

    public function execute($sql)
    {
        $query = $this->connection->prepare($sql);
        $query->execute();
    }

    public function fetch($sql)
    {
        $query = $this->connection->prepare($sql);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        if($result === false) {
            return [];
        }

        return $result;
    }


}