<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class NginxServerRunning extends BaseMetric implements MetricInterface
{
    public function populate()
    {
        $output = $this->connection->run('ps -e | grep nginx')->getOutput();

        $this->value = !empty($output);
    }

    public function getName()
    {
        return 'nginx-server-running';
    }

}