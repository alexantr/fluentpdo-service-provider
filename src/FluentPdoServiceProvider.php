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
        $app['fpdo.pdo_options'] = array();
        $app['fpdo.debug'] = false;

        $default_options = array(
            'dsn' => 'mysql:host=localhost',
            'username' => null,
            'password' => null,
            'options' => null,
        );

        $app['fpdo'] = function ($app) use ($default_options) {
            $opt = array_merge($default_options, $app['fpdo.pdo_options']);
            $pdo = new \PDO($opt['dsn'], $opt['username'], $opt['password'], $opt['options']);
            $fpdo = new \FluentPDO($pdo);
            $fpdo->debug = $app['fpdo.debug'];
            return $fpdo;
        };
    }
}