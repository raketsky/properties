<?php
declare(strict_types=1);

defined('APP_DIR') or define('APP_DIR', dirname(__FILE__));

use Illuminate\Container\Container;
use \Phpmig\Adapter;
use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__ . '/bootstrap.php';

$container = new Container();
$container['phpmig.adapter'] = new Adapter\Illuminate\Database($capsule, 'migrations', 'default');
$container['phpmig.migrations_path'] = function () {
    return __DIR__ . '/migrations';
};

//I can run this directly, because Capsule is set as globally
//with $capsule->setAsGlobal(); line at /bootstrap.php
$container['schema'] = Capsule::schema('default');

return $container;
