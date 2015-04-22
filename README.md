# FluentPDO Service Provider

Silex service provider for [FluentPDO](http://lichtner.github.io/fluentpdo/)

## Installation

Install Provider through [Composer](http://getcomposer.org/):

```
composer require alexantr/fluentpdo-service-provider "~2.0@dev"
```

## Registering and configuration

```php
$app->register(new \Alexantr\Silex\Provider\FluentPdoServiceProvider(), array(
    'fpdo.pdo_options' => array(
        'dsn' => 'mysql:dbname=blog;host=localhost;charset=UTF8',
        'username' => 'username',
        'password' => 'password',
    ),
    'fpdo.debug' => false,
));
```

## Usage

To get all records for given table:

```php
$posts = $app['fpdo']
    ->from('posts')
    ->orderBy('created_at DESC')
    ->limit(10)
    ->fetchAll();
```

For more examples see [FluentPDO documentation](http://lichtner.github.io/fluentpdo/)

## Enable debugging

Log queries to STDERR (for console debugging):

```php
$app['fpdo.debug'] = true;
```

or set callback:

```php
$app['fpdo.debug'] = function (\Silex\Application $app) {
    return function (\BaseQuery $q) use ($app) {
        // simple example with logger
        if (isset($app['logger']) && $app['logger'] !== null) {
            $debug_line = array();
            $debug_line[] = 'Query: ' . $q->getQuery(false);
            $debug_line[] = 'Params: ' . implode(', ', $q->getParameters());
            $debug_line[] = 'Row count: ' . ($q->getResult() ? $q->getResult()->rowCount() : 0);
            $debug_line[] = 'Time: ' . $q->getTime();
            $app['logger']->debug(implode(', ', $debug_line));
        }
    };
};
```
