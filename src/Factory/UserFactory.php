<?php

namespace OperatingSystem\User\Factory;

use OperatingSystem\User\User;
use OperatingSystem\User\Exception\PosixNotAvailableException;

class UserFactory
{
    /**
     * Factory method to get the owner of the currently executed script file.
     *
     * @return User
     *
     * @throws PosixNotAvailableException
     * @throws \Exception
     */
    public static function createFromExecutedFileOwner()
    {
        if (false === $uid = \getmyuid()) {
            throw new \Exception('Could not get the owner of the current script.');
        }
        return new User($uid);
    }

    /**
     * Factory method to get the effective user of the currently executed process.
     *
     * @return User
     *
     * @throws PosixNotAvailableException
     * @throws \Exception
     */
    public static function createFromEffectiveProcessUser()
    {
        if (!function_exists('posix_geteuid')) {
            throw new PosixNotAvailableException(
                'Could not retrieve information about the operating system user because POSIX functions '
                . 'are not available to your PHP executable.'
            );
        }
        if (false === $uid = \posix_geteuid()) {
            throw new \Exception('Could not get the effective user of the current process.');
        }
        return new User($uid);
    }

    /**
     * Factory method to get the real user of the currently executed process.
     *
     * @return User
     *
     * @throws PosixNotAvailableException
     * @throws \Exception
     */
    public static function createFromRealProcessUser()
    {
        if (!function_exists('posix_getuid')) {
            throw new PosixNotAvailableException(
                'Could not retrieve information about the operating system user because POSIX functions '
                . 'are not available to your PHP executable.'
            );
        }
        if (false === $uid = \posix_getuid()) {
            throw new \Exception('Could not get the real user of the current process.');
        }
        return new User($uid);
    }

    /**
     * Factory method to get the owner of a file.
     *
     * @param string    $filename
     *
     * @return User
     *
     * @throws PosixNotAvailableException
     * @throws \Exception
     */
    public static function createFromFileOwner($filename)
    {
        if (!file_exists($filename)) {
            throw new \InvalidArgumentException('Invalid file name provided.');
        }
        if (!function_exists('posix_getuid')) {
            throw new PosixNotAvailableException(
                'Could not retrieve information about the operating system user because POSIX functions '
                . 'are not available to your PHP executable.'
            );
        }
        if (false === $uid = \fileowner($filename)) {
            throw new \Exception('Could not get the owner of the file "' . $filename . '".');
        }
        return new User($uid);
    }
}
