<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class Hostname extends BaseMetric implements MetricInterface
{
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

}