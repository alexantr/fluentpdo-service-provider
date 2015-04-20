# FluentPDO Service Provider

Silex service provider for [FluentPDO](http://lichtner.github.io/fluentpdo/)

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
    return function (\BaseQuery $query) use ($app) {
        // simple example with logger
        $debug_line = array();
        $debug_line[] = 'Query: ' . $query->getQuery(false);
        $debug_line[] = 'Params: ' . implode(', ', $query->getParameters());
        $debug_line[] = 'Row count: ' . ($query->getResult() ? $query->getResult()->rowCount() : 0);
        $debug_line[] = 'Time: ' . $query->getTime();
        $app['logger']->debug(implode(', ', $debug_line));
    };
};
```
