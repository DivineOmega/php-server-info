<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class DiskUsagePercentage implements MetricInterface
{
    private $connection;
    private $value;

    public function __construct(Server $server)
    {
        $this->connection = $server->connection();
    }

    public function populate()
    {
        $command = $this->connection->run('df / --output=pcent | tail -n 1 | cut -d "%" -f 1');

        $output = $command->getOutput();

        if ($output) {
            $this->value = (int) $output;
        }
    }

    public function getName()
    {
        return 'disk-usage-percentage';
    }

    public function getValue()
    {
        return $this->value;
    }
}