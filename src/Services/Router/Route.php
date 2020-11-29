<?php


namespace App\Services\Router;


/**
 * Class Route
 * @package App\Services\Router
 */
class Route
{
    /**
     * @var string
     */
    private ?string $controllerName;
    /**
     * @var string
     */
    private ?string $actionName;

    /**
     * Route constructor.
     * @param string $controllerName
     * @param string|null $actionName
     */
    public function __construct(
        ?string $controllerName,
        ?string $actionName = null
    ) {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
    }

    /**
     * @return string
     */
    public function getActionName(): ?string
    {
        return $this->actionName;
    }

    /**
     * @return string
     */
    public function getControllerName(): ?string
    {
        return $this->controllerName;
    }

    /**
     * @param string $controllerName
     * @return Route
     */
    public function setControllerName(string $controllerName): self
    {
        $this->controllerName = $controllerName;

        return $this;
    }

    /**
     * @param string $actionName
     * @return Route
     */
    public function setActionName(string $actionName): self
    {
        $this->actionName = $actionName;

        return $this;
    }
}
