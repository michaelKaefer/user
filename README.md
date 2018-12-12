# User

Wrapper for retrieving information about an operating system user with native PHP functions

## Installation

```
composer require operating-system/user
```

## Usage

```php
$user = new User(0);

$user->getName();           // 'root'
$user->getPassword();       // 'x'
$user->getUid();            // 0
$user->getGid();            // 0
$user->getGecos();          // 'root'
$user->getHomeDirectory();  // 'root'
$user->getShell();          // '/bin/bash'
```

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](https://github.com/operating-system/user/blob/master/LICENSE) for more information.
