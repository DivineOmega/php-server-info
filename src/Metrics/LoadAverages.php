<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class LoadAverages extends BaseMetric implements MetricInterface
{
    public function populate()
    {
        $command = $this->connection->run('cat /proc/loadavg');

        $output = $command->getOutput();

        if ($output) {
            $loadAverages = explode(' ', $output);
            $this->value = [
                1  => (float) $loadAverages[0],
                5  => (float) $loadAverages[1],
                15 => (float) $loadAverages[2],
            ];
        }
    }

    public function getName()
    {
        return 'load-averages';
    }

}