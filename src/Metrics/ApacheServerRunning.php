<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class ApacheServerRunning implements MetricInterface
{
    private $connection;
    private $value;

    public function __construct(Server $server)
    {
        $this->connection = $server->connection();
    }

    public function populate()
    {
        $output1 = $this->connection->run('ps -e | grep apache2')->getOutput();
        $output2 = $this->connection->run('ps -e | grep httpd')->getOutput();

        $this->value = !empty($output1) || !empty($output2);
    }

    public function getName()
    {
        return 'apache-server-running';
    }

    public function getValue()
    {
        return $this->value;
    }
}