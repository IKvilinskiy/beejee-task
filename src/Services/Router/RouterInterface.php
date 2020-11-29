<?php


namespace App\Services\Router;


use App\Services\Router\Strategy\StrategyInterface;

/**
 * Interface RouterInterface
 * @package App\Services\Router
 */
interface RouterInterface
{
    /**
     * RouterInterface constructor.
     * @param StrategyInterface $strategy
     */
    public function __construct(StrategyInterface $strategy);

    public function run(): void;
}
