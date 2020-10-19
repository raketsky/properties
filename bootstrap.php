<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Yaml\Yaml;

defined('APP_DIR') or define('APP_DIR', dirname(__FILE__));

date_default_timezone_set('Europe/Riga');

require APP_DIR . '/vendor/autoload.php';

function getConfig($key, $default = null)
{
    $config = Yaml::parse(file_get_contents(APP_DIR . '/config/parameters.yml'));
    if (!isset($config['settings']) || !$config['settings']) {
        return $default;
    }
    return isset($config['settings'][$key]) ? $config['settings'][$key] : $default;
}

defined('IS_PROD') or define('IS_PROD', getConfig('env') === 'prod');

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
