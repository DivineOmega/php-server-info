<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

class ActiveHttpConnection implements MetricInterface
{
    private $connection;
    private $value;

    public function __construct(Server $server)
    {
        $this->connection = $server->connection();
    }

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

    public function getValue()
    {
        return $this->value;
    }
}