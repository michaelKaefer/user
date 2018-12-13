<?php

namespace OperatingSystem\User;

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
     * @throws \Exception
     */
    public function __construct($uid)
    {
        if (!function_exists('posix_getpwuid')) {
            throw new \Exception(
                'Could not retrieve information about the operating system user because POSIX functions '
                . 'are not available to your PHP executable.'
            );
        }
        $this->passwd = \posix_getpwuid($uid);
    }

    public function getName()
    {
        if (!array_key_exists(self::NAME, $this->passwd)) {
            throw new \Exception('Could not get user name from passwd.');
        }
        return $this->passwd[self::NAME];
    }

    public function getPassword()
    {
        if (!array_key_exists(self::PASSWORD, $this->passwd)) {
            throw new \Exception('Could not get user password from passwd.');
        }
        return $this->passwd[self::PASSWORD];
    }

    public function getUid()
    {
        if (!array_key_exists(self::UID, $this->passwd)) {
            throw new \Exception('Could not get user id from passwd.');
        }
        return $this->passwd[self::UID];
    }

    public function getGid()
    {
        if (!array_key_exists(self::GID, $this->passwd)) {
            throw new \Exception('Could not get user\'s group id from passwd.');
        }
        return $this->passwd[self::GID];
    }

    public function getGecos()
    {
        if (!array_key_exists(self::GECOS, $this->passwd)) {
            throw new \Exception('Could not get user gecos from passwd.');
        }
        return $this->passwd[self::GECOS];
    }

    public function getHomeDirectory()
    {
        if (!array_key_exists(self::HOME_DIRECTORY, $this->passwd)) {
            throw new \Exception('Could not get user\'s home directory from passwd.');
        }
        return $this->passwd[self::HOME_DIRECTORY];
    }

    public function getShell()
    {
        if (!array_key_exists(self::SHELL, $this->passwd)) {
            throw new \Exception('Could not get user shell from passwd.');
        }
        return $this->passwd[self::SHELL];
    }
}
