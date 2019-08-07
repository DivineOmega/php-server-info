<?php

namespace DivineOmega\ServerInfo\Interfaces;

use DivineOmega\ServerInfo\Server;

interface MetricInterface
{
    public function __construct(Server $server);

    public function populate();

    public function getName();
    public function getValue();
}