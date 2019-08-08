<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class TotalMemoryBytes extends BaseMetric implements MetricInterface
{
    public function populate()
    {
        $command = $this->connection->run('awk \'/^Mem/ {print $2}\' <(free)');

        $output = $command->getOutput();

        if ($output) {
            $this->value = (int) $output;
        }
    }

    public function getName()
    {
        return 'total-memory-bytes';
    }

}