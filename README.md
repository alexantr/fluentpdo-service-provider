# FluentPDO Service Provider

Silex service provider for [FluentPDO](http://lichtner.github.io/fluentpdo/)

## Registering and configuration

```php
$app->register(new \Alexantr\Silex\Provider\FluentPdoServiceProvider(), array(
    'fpdo.dsn' => 'mysql:host=localhost;dbname=blog',
    'fpdo.username' => 'username',
    'fpdo.password' => 'password',
);
```

## Usage

To get all records for given table:

```php
$posts = $app['fpdo']->from('posts')->orderBy('created_at DESC')->offset(0)->limit(10)->fetchAll();
```

For more examples see [FluentPDO documentation](http://lichtner.github.io/fluentpdo/)
