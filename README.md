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
);
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
