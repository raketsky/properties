<?php
date_default_timezone_set('Europe/Riga');

use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Yaml\Yaml;

require __DIR__ . '/vendor/autoload.php';

function getConfig($key, $default = null)
{
    $config = Yaml::parse(file_get_contents(__DIR__ . '/config/parameters.yml'));
    if (!isset($config['settings']) || !$config['settings']) {
        return $default;
    }
    return isset($config['settings'][$key]) ? $config['settings'][$key] : $default;
}

$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => getConfig('db_host'),
    'database' => getConfig('db_database'),
    'username' => getConfig('db_username'),
    'password' => getConfig('db_password'),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'eloquent' => true
], 'default');

$capsule->setAsGlobal();
$capsule->bootEloquent();
