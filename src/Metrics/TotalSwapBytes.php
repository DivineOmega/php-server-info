<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class TotalSwapBytes implements MetricInterface
{
    private $connection;
    private $value;

    public function __construct(Server $server)
    {
        $this->connection = $server->connection();
    }

    public function populate()
    {
        $command = $this->connection->run('awk \'/^Swap/ {print $2}\' <(free)');

        $output = $command->getOutput();

        if ($output) {
            $this->value = (int) $output;
        }
    }

    public function getName()
    {
        return 'total-swap-bytes';
    }

    public function getValue()
    {
        return $this->value;
    }
}