<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class MySqlServerRunning implements MetricInterface
{
    private $connection;
    private $value;

    public function __construct(Server $server)
    {
        $this->connection = $server->connection();
    }

    public function populate()
    {
        $output = $this->connection->run('ps -e | grep mysqld')->getOutput();

        $this->value = !empty($output);
    }

    public function getName()
    {
        return 'mysql-server-running';
    }

    public function getValue()
    {
        return $this->value;
    }
}