<?php

require 'vendor/autoload.php';


$user = new OperatingSystem\User\User(0);
var_dump(
$user->getName(),
$user->getPassword(),
$user->getUid(),
$user->getGid(),
$user->getGecos(),
$user->getHomeDirectory(),
$user->getShell()
);