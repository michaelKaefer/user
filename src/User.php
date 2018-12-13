<?php

namespace OperatingSystem\User;

use OperatingSystem\User\Exception\PosixNotAvailableException;

class User
{
    const NAME = 'name';
    const PASSWORD = 'passwd';
    const UID = 'uid';
    const GID = 'gid';
    const GECOS = 'gecos';
    const HOME_DIRECTORY = 'dir';
    const SHELL = 'shell';

    /**
     * @var array
     */
    private $passwd;

    /**
     * Owner constructor.
     *
     * @param int $uid
     *
     * @throws PosixNotAvailableException
     */
    public function __construct($uid)
    {
        if (!function_exists('posix_getpwuid')) {
            throw new PosixNotAvailableException(
                'Could not retrieve information about the operating system user because POSIX functions '
                . 'are not available to your PHP executable.'
            );
        }
        $this->passwd = \posix_getpwuid($uid);
    }

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
        return new static($uid);
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
        return new static($uid);
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
        return new static($uid);
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
        return new static($uid);
    }

    /**
     * @return string
     *
     * @throws \Exception
     */
    public function getName()
    {
        if (!array_key_exists(self::NAME, $this->passwd)) {
            throw new \Exception('Could not get user name from passwd.');
        }
        return $this->passwd[self::NAME];
    }

    /**
     * @return string
     *
     * @throws \Exception
     */
    public function getPassword()
    {
        if (!array_key_exists(self::PASSWORD, $this->passwd)) {
            throw new \Exception('Could not get user password from passwd.');
        }
        return $this->passwd[self::PASSWORD];
    }

    /**
     * @return int
     *
     * @throws \Exception
     */
    public function getUid()
    {
        if (!array_key_exists(self::UID, $this->passwd)) {
            throw new \Exception('Could not get user id from passwd.');
        }
        return $this->passwd[self::UID];
    }

    /**
     * @return int
     *
     * @throws \Exception
     */
    public function getGid()
    {
        if (!array_key_exists(self::GID, $this->passwd)) {
            throw new \Exception('Could not get user\'s group id from passwd.');
        }
        return $this->passwd[self::GID];
    }

    /**
     * @return string
     *
     * @throws \Exception
     */
    public function getGecos()
    {
        if (!array_key_exists(self::GECOS, $this->passwd)) {
            throw new \Exception('Could not get user gecos from passwd.');
        }
        return $this->passwd[self::GECOS];
    }

    /**
     * @return string
     *
     * @throws \Exception
     */
    public function getHomeDirectory()
    {
        if (!array_key_exists(self::HOME_DIRECTORY, $this->passwd)) {
            throw new \Exception('Could not get user\'s home directory from passwd.');
        }
        return $this->passwd[self::HOME_DIRECTORY];
    }

    /**
     * @return string
     *
     * @throws \Exception
     */
    public function getShell()
    {
        if (!array_key_exists(self::SHELL, $this->passwd)) {
            throw new \Exception('Could not get user shell from passwd.');
        }
        return $this->passwd[self::SHELL];
    }
}
