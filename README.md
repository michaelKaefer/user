# User

Wrapper for retrieving information about an operating system user with native PHP functions

## Installation

```
composer require operating-system/user
```

## Usage

Instantiate user with uid 0:

```php
try {
    $user = new \OperatingSystem\User\User(0);
} catch (\OperatingSystem\User\Exception\PosixNotAvailableException $e) {
    $e->getMessage;         // 'Could not retrieve information about the 
                            // operating system user because POSIX functions
                            // are not available to your PHP executable.'
}
```

Get user information for user with uid 0:

```php
$user->getName();           // 'root'
$user->getPassword();       // 'x'
$user->getUid();            // 0
$user->getGid();            // 0
$user->getGecos();          // 'root'
$user->getHomeDirectory();  // 'root'
$user->getShell();          // '/bin/bash'
```

Factory methods:
```php
try {
    $user = \OperatingSystem\User\Factory\UserFactory::createFromExecutedFileOwner();
} catch (\OperatingSystem\User\Exception\PosixNotAvailableException $e) {
    $e->getMessage;         // 'Could not retrieve information about the 
                            // operating system user because POSIX functions
                            // are not available to your PHP executable.'
} catch (\Exception $e) {
    $e->getMessage;         // 'Could not get the owner of the current script.'
}

try {
    $user = \OperatingSystem\User\Factory\UserFactory::createFromEffectiveProcessUser();
} catch (\OperatingSystem\User\Exception\PosixNotAvailableException $e) {
    $e->getMessage;         // 'Could not retrieve information about the 
                            // operating system user because POSIX functions
                            // are not available to your PHP executable.'
} catch (\Exception $e) {
    $e->getMessage;         // 'Could not get the effective user of the current process.'
}

try {
    $user = \OperatingSystem\User\Factory\UserFactory::createFromRealProcessUser();
} catch (\OperatingSystem\User\Exception\PosixNotAvailableException $e) {
    $e->getMessage;         // 'Could not retrieve information about the 
                            // operating system user because POSIX functions
                            // are not available to your PHP executable.'
} catch (\Exception $e) {
    $e->getMessage;         // 'Could not get the real user of the current process.'
}

try {
    $user = \OperatingSystem\User\Factory\UserFactory::createFromFileOwner(__FILE__);
} catch (\InvalidArgumentException $e) {
    $e->getMessage;         // 'Invalid file name provided.'
} catch (\OperatingSystem\User\Exception\PosixNotAvailableException $e) {
    $e->getMessage;         // 'Could not retrieve information about the 
                            // operating system user because POSIX functions
                            // are not available to your PHP executable.'
} catch (\Exception $e) {
    $e->getMessage;         // 'Could not get the real user of the current process.'
}
```

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](https://github.com/operating-system/user/blob/master/LICENSE) for more information.
