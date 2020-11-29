<?php


namespace App\Services\Router;


use App\Services\Router\Strategy\StrategyInterface;
use App\Services\UrlBuilder\UrlBuilderInterface;

/**
 * Interface HttpRouterKitInterface
 * @package App\Services\Router
 */
interface HttpRouterKitInterface
{
    /**
     * @return UrlBuilderInterface
     */
    public function getUrlBuilder(): UrlBuilderInterface;

    /**
     * @return StrategyInterface
     */
    public function getStrategy(): StrategyInterface;
}
