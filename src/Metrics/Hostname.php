<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class Hostname implements MetricInterface
{
    private $connection;
    private $value;

    public function __construct(Server $server)
    {
        $this->connection = $server->connection();
    }

    public function populate()
    {
        $command = $this->connection->run('hostname');

        $output = $command->getOutput();

        if ($output) {
            $this->value = $output;
        }
    }

    public function getName()
    {
        return 'hostname';
    }

    public function getValue()
    {
        return $this->value;
    }
}