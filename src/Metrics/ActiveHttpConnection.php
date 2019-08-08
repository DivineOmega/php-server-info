<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class ActiveHttpConnection extends BaseMetric implements MetricInterface
{
    public function populate()
    {
        $activeConnections = 0;

        foreach ([80, 443] as $port) {
            $activeConnections += (int) $this->connection
                ->run('netstat -an | grep :'.$port.' | grep ESTABLISHED | wc -l')
                ->getOutput();
        }

        $this->value = $activeConnections;
    }

    public function getName()
    {
        return 'active-http-connections';
    }
}