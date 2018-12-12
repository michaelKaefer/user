<?php

namespace OperatingSystem\User\Tests;

use OperatingSystem\User\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @var User
     */
    protected $user;

    protected function setUp()
    {
        $this->user = new User(0);
    }

    protected function tearDown()
    {
        $this->user = null;
    }

    public function testInstantiation()
    {
        $this->assertInstanceOf(User::class, $this->user);
    }

    public function testGetName()
    {
        $this->assertIsString($this->user->getName());
    }

    public function testGetPassword()
    {
        $this->assertIsString($this->user->getPassword());
    }

    public function testGetUid()
    {
        $this->assertIsInt($this->user->getUid());
    }

    public function testGetGid()
    {
        $this->assertIsInt($this->user->getGid());
    }

    public function testGetGecos()
    {
        $this->assertIsString($this->user->getGecos());
    }

    public function testHomeDirectory()
    {
        $this->assertIsString($this->user->getHomeDirectory());
    }

    public function testGetShell()
    {
        $this->assertIsString($this->user->getShell());
    }
}
