<?php

namespace Demo\Database;

use \PDO;

class Connection {

    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        //FIXME: replace with real config 
        $config = [
            "host" => "127.0.0.1",
            "dbname" => "demo",
            "username" => "app",
            "password" => "root"
        ];

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