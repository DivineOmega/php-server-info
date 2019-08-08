<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class ApacheServerRunning extends BaseMetric implements MetricInterface
{
    public function populate()
    {
        $output1 = $this->connection->run('ps -e | grep apache2')->getOutput();
        $output2 = $this->connection->run('ps -e | grep httpd')->getOutput();

        $this->value = !empty($output1) || !empty($output2);
    }

    public function getName()
    {
        return 'apache-server-running';
    }

}