<?php

namespace DivineOmega\ServerInfo;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Metrics\DiskUsagePercentage;
use DivineOmega\ServerInfo\Metrics\HostnameMetric;
use DivineOmega\ServerInfo\Metrics\UptimeMetric;

class Metrics
{
    private $server;

    private const METRIC_CLASSES = [
        UptimeMetric::class,
        HostnameMetric::class,
        DiskUsagePercentage::class,
    ];

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    public function all(): array
    {
        return array_map(function($metricClass) {
            return $this->get($metricClass);
        }, self::METRIC_CLASSES);
    }

    public function toArray()
    {
        $values = [];

        foreach($this->all() as $metric) {
            $values[$metric->getName()] = $metric->getValue();
        }

        return $values;
    }

    public function get($metricClass = null): MetricInterface
    {
        /** @var MetricInterface $metric */
        $metric = new $metricClass($this->server);
        $metric->populate();

        return $metric;
    }
}