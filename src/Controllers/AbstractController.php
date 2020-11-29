<?php


namespace App\Controllers;


use App\Services\Renderer\RendererInterface;

/**
 * Class AbstractController
 * @package App\Controllers
 */
abstract class AbstractController implements ControllerInterface
{
    protected const SESSION_AUTH_NAME = 'auth';

    /**
     * @var RendererInterface
     */
    protected RendererInterface $renderer;

    /**
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * AbstractController constructor.
     * @param RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param string $viewPath
     * @param array $params
     */
    public function render(string $viewPath, $params = []): void
    {
        $params = [
            '_viewPath' => $viewPath,
            '_vars' => $params,
            '_title' => $this->title,
            '_isGuest' => $this->userIsGuest()
        ];

        $this->renderer->render('layout.php', $params);
    }

    /**
     * @param array $data
     * @return array
     */
    public function escapeRequestData(array $data): array
    {
        return array_map(function ($item) {
            switch (gettype($item)) {
                case 'string':
                    $item = htmlspecialchars($item);
                    break;
                case 'array':
                    $item = $this->escapeRequestData($item);
                    break;
            }

            return $item;
        }, $data);
    }

    /**
     * @return bool
     */
    protected function userIsGuest(): bool
    {
        return !(
            isset($_SESSION[self::SESSION_AUTH_NAME])
            && $_SESSION[self::SESSION_AUTH_NAME]
        );
    }
}
