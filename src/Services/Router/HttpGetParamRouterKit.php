<?php


namespace App\Services\Router;


use App\Services\Router\Strategy\GetParamsStrategy;
use App\Services\Router\Strategy\StrategyInterface;
use App\Services\UrlBuilder\GetParamsUrlBuilder;
use App\Services\UrlBuilder\UrlBuilderInterface;

/**
 * Class HttpRouterKit
 * @package App\Services\Router
 */
class HttpGetParamRouterKit implements HttpRouterKitInterface
{
    /**
     * @var HttpGetParamRouterKit|null
     */
    private static ?self $instance = null;

    /**
     * HttpRouterKit constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return HttpGetParamRouterKit
     */
    public static function getInstance(): HttpRouterKitInterface
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return UrlBuilderInterface
     */
    public function getUrlBuilder(): UrlBuilderInterface
    {
        return new GetParamsUrlBuilder();
    }

    /**
     * @return StrategyInterface
     */
    public function getStrategy(): StrategyInterface
    {
        return new GetParamsStrategy();
    }

}
