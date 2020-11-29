<?php

use App\Services\ServiceContainer;

require_once "vendor/autoload.php";

session_start();

try {
    ServiceContainer::getInstance()
        ->getRouter()
        ->run();
} catch (Exception $e) {
    http_response_code($e->getCode());
    echo $e->getMessage();
}
