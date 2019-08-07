<?php

use DivineOmega\ServerInfo\Server;
use DivineOmega\SSHConnection\SSHConnection;

require_once __DIR__.'/../vendor/autoload.php';

$connection = (new SSHConnection())
    ->to(getenv('TEST_HOSTNAME'))
    ->as(getenv('TEST_USERNAME'))
    ->withKeyPair('/home/jordan/.ssh/id_rsa.pub', '/home/jordan/.ssh/id_rsa');

$array = (new Server($connection))
    ->metrics()
    ->toArray();

var_dump($array);
