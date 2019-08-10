<?php

namespace DivineOmega\ServerInfo\Metrics;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Server;

abstract class BaseMetric implements MetricInterface
{
    protected $connection;
    protected $value;

    public function __construct(Server $server)
    {
        $this->connection = $server->connection();
        $this->populate();
    }

    public function getValue()
    {
        return $this->value;
    }

    public function toArray()
    {
        return [$this->getName() => $this->getValue()];
    }
}