<?php

namespace OperatingSystem\User\Tests;

use OperatingSystem\User\User;
use OperatingSystem\User\Factory\UserFactory;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @var User
     */
    protected $ownerOfCurrentScript;

    /**
     * @var User
     */
    protected $effectiveUserOfCurrentProcess;

    /**
     * @var User
     */
    protected $realUserOfCurrentProcess;

    /**
     * @var User
     */
    protected $ownerOfThisFile;

    protected function setUp()
    {
        $this->ownerOfCurrentScript = UserFactory::createFromExecutedFileOwner();
        $this->effectiveUserOfCurrentProcess = UserFactory::createFromEffectiveProcessUser();
        $this->realUserOfCurrentProcess = UserFactory::createFromRealProcessUser();
        $this->ownerOfThisFile = UserFactory::createFromFileOwner(__FILE__);
    }

    protected function tearDown()
    {
        $this->ownerOfCurrentScript = null;
        $this->effectiveUserOfCurrentProcess = null;
        $this->realUserOfCurrentProcess = null;
        $this->ownerOfThisFile = null;
    }

    public function testInstantiation()
    {
        $this->assertInstanceOf(User::class, $this->ownerOfCurrentScript);
        $this->assertInstanceOf(User::class, $this->effectiveUserOfCurrentProcess);
        $this->assertInstanceOf(User::class, $this->realUserOfCurrentProcess);
        $this->assertInstanceOf(User::class, $this->ownerOfThisFile);
    }

    public function testGetName()
    {
        $this->assertIsString($this->ownerOfCurrentScript->getName());
        $this->assertIsString($this->effectiveUserOfCurrentProcess->getName());
        $this->assertIsString($this->realUserOfCurrentProcess->getName());
        $this->assertIsString($this->ownerOfThisFile->getName());
    }

    public function testGetPassword()
    {
        $this->assertIsString($this->ownerOfCurrentScript->getPassword());
        $this->assertIsString($this->effectiveUserOfCurrentProcess->getPassword());
        $this->assertIsString($this->realUserOfCurrentProcess->getPassword());
        $this->assertIsString($this->ownerOfThisFile->getPassword());
    }

    public function testGetUid()
    {
        $this->assertIsInt($this->ownerOfCurrentScript->getUid());
        $this->assertIsInt($this->effectiveUserOfCurrentProcess->getUid());
        $this->assertIsInt($this->realUserOfCurrentProcess->getUid());
        $this->assertIsInt($this->ownerOfThisFile->getUid());
    }

    public function testGetGid()
    {
        $this->assertIsInt($this->ownerOfCurrentScript->getGid());
        $this->assertIsInt($this->effectiveUserOfCurrentProcess->getGid());
        $this->assertIsInt($this->realUserOfCurrentProcess->getGid());
        $this->assertIsInt($this->ownerOfThisFile->getGid());
    }

    public function testGetGecos()
    {
        $this->assertIsString($this->ownerOfCurrentScript->getGecos());
        $this->assertIsString($this->effectiveUserOfCurrentProcess->getGecos());
        $this->assertIsString($this->realUserOfCurrentProcess->getGecos());
        $this->assertIsString($this->ownerOfThisFile->getGecos());
    }

    public function testHomeDirectory()
    {
        $this->assertIsString($this->ownerOfCurrentScript->getHomeDirectory());
        $this->assertIsString($this->effectiveUserOfCurrentProcess->getHomeDirectory());
        $this->assertIsString($this->realUserOfCurrentProcess->getHomeDirectory());
        $this->assertIsString($this->ownerOfThisFile->getHomeDirectory());
    }

    public function testGetShell()
    {
        $this->assertIsString($this->ownerOfCurrentScript->getShell());
        $this->assertIsString($this->effectiveUserOfCurrentProcess->getShell());
        $this->assertIsString($this->realUserOfCurrentProcess->getShell());
        $this->assertIsString($this->ownerOfThisFile->getShell());
    }
}
