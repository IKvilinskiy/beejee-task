<?php


namespace App\Controllers;


use App\Services\Renderer\RendererInterface;

/**
 * Interface ControllerInterface
 * @package App\Controllers
 */
interface ControllerInterface
{
    /**
     * ControllerInterface constructor.
     * @param RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer);

    /**
     * @param string $viewPath
     * @param array $params
     */
    public function render(string $viewPath, $params = []): void;
}
