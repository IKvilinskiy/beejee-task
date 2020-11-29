<?php


namespace App\Services\Renderer;


/**
 * Class HTMLRenderer
 * @package App\Services\Renderer
 */
class HTMLRenderer implements RendererInterface
{
    /**
     * @param string $viewPath
     * @param array $params
     */
    public function render(string $viewPath, array $params = []): void
    {
        if (!empty($params)) extract($params);

        if (!isset($renderer)) $renderer = $this;

        include realpath(__DIR__ . '/../../Views') . '/' . $viewPath;
    }
}
