<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class Uptime extends BaseMetric implements MetricInterface
{
    public function populate()
    {
        $command = $this->connection->run('cat /proc/uptime | cut -d " " -f 1');

        $output = $command->getOutput();

        if ($output) {
            $this->value = (int) $output;
        }
    }

    public function getName()
    {
        return 'uptime';
    }

}