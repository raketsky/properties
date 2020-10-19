#!/usr/bin/env php
<?php
declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$application = new \Symfony\Component\Console\Application();
$application->add(new \App\Command\FetchDataCommand());
$application->run();
