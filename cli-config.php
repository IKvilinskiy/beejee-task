<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use App\Services\ServiceContainer;

require_once 'vendor/autoload.php';

return ConsoleRunner::createHelperSet(
    ServiceContainer::getInstance()->getEntityManager()
);
