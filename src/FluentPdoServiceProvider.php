<?php

namespace Alexantr\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class FluentPdoServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['fpdo.dsn'] = 'mysql:host=localhost;dbname=blog;charset=UTF8';
        $app['fpdo.username'] = 'root';
        $app['fpdo.password'] = '';
        $app['fpdo.options'] = array();
        $app['fpdo.debug'] = false;

        $app['fpdo'] = function ($app) {
            $pdo = new \PDO($app['fpdo.dsn'], $app['fpdo.username'], $app['fpdo.password'], $app['fpdo.options']);
            $fpdo = new \FluentPDO($pdo);
            $fpdo->debug = $app['fpdo.debug'];
            return $fpdo;
        };
    }
}