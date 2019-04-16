<?php
declare(strict_types=1);

use Illuminate\Container\Container;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new Container();

(new \LaraMarketing\Providers\MailServiceProvider($container))->register();

return $container;