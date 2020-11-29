<?php


namespace App\Services\UrlBuilder;


use App\Services\Router\HttpRouter;

/**
 * Class GetParamsUrlBuilder
 * @package App\Services\UrlBuilder
 */
class GetParamsUrlBuilder implements UrlBuilderInterface
{
    /**
     * @var array
     */
    private array $params = [];

    /**
     * @param string $controller
     * @return UrlBuilderInterface
     */
    public function setController(string $controller): UrlBuilderInterface
    {
        if ($controller != HttpRouter::DEFAULT_CONTROLLER)
            $this->params['controller'] = $controller;

        return $this;
    }

    /**
     * @param string $acton
     * @return UrlBuilderInterface
     */
    public function setAction(string $acton): UrlBuilderInterface
    {
        if ($acton != HttpRouter::DEFAULT_ACTION)
        $this->params['action'] = $acton;

        return $this;
    }

    /**
     * @param array $params
     * @return UrlBuilderInterface
     */
    public function setParams(array $params): UrlBuilderInterface
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        $httpQuery = http_build_query($this->params);

        $link = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']
            . ($httpQuery ? '/?' . $httpQuery : '');

        $this->params = [];

        return $link;
    }


}
