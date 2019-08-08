<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class TotalDiskSpaceBytes extends BaseMetric implements MetricInterface
{
    public function populate()
    {
        $command = $this->connection->run('df / --output=avail | tail -n 1');

        $output = $command->getOutput();

        if ($output) {
            $this->value = (int) $output;
        }
    }

    public function getName()
    {
        return 'total-disk-space-bytes';
    }

}