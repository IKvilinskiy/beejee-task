<?php

namespace App\Services\Renderer;

/**
 * Interface RendererInterface
 * @package App\Services\Renderer
 */
interface RendererInterface
{
    /**
     * @param string $viewPath
     * @param array $params
     */
    public function render(string $viewPath, array $params = []): void;
}
