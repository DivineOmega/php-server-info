<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class NginxServerRunning implements MetricInterface
{
    private $connection;
    private $value;

    public function __construct(Server $server)
    {
        $this->connection = $server->connection();
    }

    public function populate()
    {
        $output = $this->connection->run('ps -e | grep nginx')->getOutput();

        $this->value = !empty($output);
    }

    public function getName()
    {
        return 'nginx-server-running';
    }

    public function getValue()
    {
        return $this->value;
    }
}