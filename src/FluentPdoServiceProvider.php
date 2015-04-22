<?php

namespace Alexantr\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * FluentPDO Service Provider
 *
 * @author Alex Yashkin <alex.yashkin@gmail.com>
 */
class FluentPdoServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['fpdo.pdo_options'] = array(
            'dsn' => 'mysql:dbname=test;host=localhost',
            'username' => 'root',
            'password' => '',
            'options' => array(),
        );
        $app['fpdo.debug'] = false;

        $app['fpdo'] = function ($app) {
            $opt = $app['fpdo.pdo_options'];
            $pdo = new \PDO($opt['dsn'], $opt['username'], $opt['password'], (array)$opt['options']);
            $fpdo = new \FluentPDO($pdo);
            $fpdo->debug = $app['fpdo.debug'];
            return $fpdo;
        };
    }
}