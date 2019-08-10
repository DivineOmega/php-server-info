<?php

namespace DivineOmega\ServerInfo;

use DivineOmega\ServerInfo\Interfaces\MetricInterface;
use DivineOmega\ServerInfo\Metrics\ActiveHttpConnection;
use DivineOmega\ServerInfo\Metrics\ApacheServerRunning;
use DivineOmega\ServerInfo\Metrics\DiskUsagePercentage;
use DivineOmega\ServerInfo\Metrics\LoadAverages;
use DivineOmega\ServerInfo\Metrics\MemoryUsagePercentage;
use DivineOmega\ServerInfo\Metrics\Hostname;
use DivineOmega\ServerInfo\Metrics\MySqlServerRunning;
use DivineOmega\ServerInfo\Metrics\NginxServerRunning;
use DivineOmega\ServerInfo\Metrics\SwapUsagePercentage;
use DivineOmega\ServerInfo\Metrics\TotalDiskSpaceBytes;
use DivineOmega\ServerInfo\Metrics\TotalMemoryBytes;
use DivineOmega\ServerInfo\Metrics\TotalSwapBytes;
use DivineOmega\ServerInfo\Metrics\Uptime;

class Metrics
{
    private $server;

    private const METRIC_CLASSES = [
        Uptime::class,
        Hostname::class,
        DiskUsagePercentage::class,
        TotalDiskSpaceBytes::class,
        MemoryUsagePercentage::class,
        TotalMemoryBytes::class,
        SwapUsagePercentage::class,
        TotalSwapBytes::class,
        MySqlServerRunning::class,
        ApacheServerRunning::class,
        NginxServerRunning::class,
        ActiveHttpConnection::class,
        LoadAverages::class,
    ];

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    public function all(): array
    {
        return array_map(function($metricClass) {
            return new $metricClass($this->server);
        }, self::METRIC_CLASSES);
    }

    public function toArray()
    {
        $values = [];

        foreach($this->all() as $metric) {
            $values = array_merge($values, $metric->toArray());
        }

        return $values;
    }

}