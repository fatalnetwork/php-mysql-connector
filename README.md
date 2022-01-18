# PHP MySQL Connector (php-mysql-connector) v4.1.0
Connects one or more MySQL databases in your PHP application

# Requirements
PHP 5 or higher, MySQL or MariaDB

# How to use
## include library
```php
require_once './[PATH-TO-FILE]/MysqlConnector.php';
```
<i>Replace [PATH-TO-FILE] with your path to this file</i>

## define configuration
```php
$config = array(
  'host' => 'hostname or ip',
  'user' => 'database-user',
  'pass' => 'database-user-password',
  'database' => 'database-name',
);
```

## instance application
```php
$db = new MysqlConnector();
```

## connect to your database
```php
$db->connect($config['host'], $config['user'], $config['pass'], $config['database']);
```

## make a query and get results directly
```php
$query_results = $db->query('SELECT column_a, column_b AS column_d, column_c FROM table');
```

## escape your string
```php
$my_escaped_string = $db->get_escaped_string($string);
```

## close the connection to your database
```php
$db->close();
```

# License
This bundle is under the MIT license.
