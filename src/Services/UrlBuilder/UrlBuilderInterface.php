<?php


namespace App\Services\UrlBuilder;


/**
 * Interface UrlBuilderInterface
 * @package App\Services\UrlBuilder
 */
interface UrlBuilderInterface
{
    /**
     * @param string $controller
     * @return UrlBuilderInterface
     */
    public function setController(string $controller): self;

    /**
     * @param string $acton
     * @return UrlBuilderInterface
     */
    public function setAction(string $acton): self;

    /**
     * @param array $params
     * @return UrlBuilderInterface
     */
    public function setParams(array $params): self;

    /**
     * @return string
     */
    public function getUrl(): string;
}
