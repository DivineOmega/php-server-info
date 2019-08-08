<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class MySqlServerRunning extends BaseMetric implements MetricInterface
{
    public function populate()
    {
        $output = $this->connection->run('ps -e | grep mysqld')->getOutput();

        $this->value = !empty($output);
    }

    public function getName()
    {
        return 'mysql-server-running';
    }

}