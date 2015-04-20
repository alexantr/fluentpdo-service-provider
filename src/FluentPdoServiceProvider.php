<?php

namespace Alexantr\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

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
            $options = $app['fpdo.pdo.options'];
            $dsn = isset($options['dsn']) ? $options['dsn'] : 'mysql:dbname=test;host=localhost';
            $username = isset($options['username']) ? $options['username'] : 'root';
            $password = isset($options['password']) ? $options['password'] : '';
            $options = isset($options['options']) && is_array($options['options']) ? $options['options'] : array();
            $pdo = new \PDO($dsn, $username, $password, $options);
            $fpdo = new \FluentPDO($pdo);
            $fpdo->debug = $app['fpdo.debug'];
            return $fpdo;
        };
    }
}