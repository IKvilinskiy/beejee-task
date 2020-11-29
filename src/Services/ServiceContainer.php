<?php

namespace App\Services;

use App\Services\Config\ConfigInterface;
use App\Services\Config\YamlConfig;
use App\Services\Renderer\HTMLRenderer;
use App\Services\Renderer\RendererInterface;
use App\Services\Router\HttpRouter;
use App\Services\Router\HttpGetParamRouterKit;
use App\Services\Router\HttpRouterKitInterface;
use App\Services\Router\RouterInterface;
use App\Services\UrlBuilder\UrlBuilderInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

/**
 * Class ServiceContainer
 * @package App\Services
 */
class ServiceContainer
{
    /**
     * @var ServiceContainer|null
     */
    private static ?self $instance = null;
    /**
     * @var RendererInterface
     */
    private ?RendererInterface $renderer = null;
    /**
     * @var RouterInterface
     */
    private ?RouterInterface $router = null;
    /**
     * @var UrlBuilderInterface
     */
    private ?UrlBuilderInterface $urlBuilder = null;
    /**
     * @var ConfigInterface|null
     */
    private ?ConfigInterface $config = null;
    /**
     * @var HttpRouterKitInterface
     */
    private HttpRouterKitInterface $httpRouterKit;
    /**
     * @var EntityManagerInterface
     */
    private ?EntityManagerInterface $entityManager = null;

    /**
     * ServiceContainer constructor.
     */
    private function __construct()
    {
        $this->httpRouterKit = HttpGetParamRouterKit::getInstance();
    }

    /**
     * @return ServiceContainer|null
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return RendererInterface
     */
    public function getRenderer(): RendererInterface
    {
        if (!$this->renderer) $this->renderer = new HTMLRenderer();

        return $this->renderer;
    }

    /**
     * @return RouterInterface
     */
    public function getRouter(): RouterInterface
    {
        if (!$this->router)
            $this->router = new HttpRouter($this->httpRouterKit->getStrategy());

        return $this->router;
    }

    /**
     * @return ConfigInterface
     */
    public function getConfig(): ConfigInterface
    {
        if (!$this->config) $this->config = new YamlConfig();

        return $this->config;
    }

    /**
     * @return UrlBuilderInterface
     */
    public function getUrlBuilder(): UrlBuilderInterface
    {
        if (!$this->urlBuilder)
            $this->urlBuilder = $this->httpRouterKit->getUrlBuilder();

        return $this->urlBuilder;
    }

    /**
     * @return EntityManagerInterface
     * @throws \Doctrine\ORM\ORMException
     */
    public function getEntityManager(): EntityManagerInterface
    {
        if (!$this->entityManager) {
            $config = Setup::createAnnotationMetadataConfiguration(
                [realpath(__DIR__ . '/../Models')],
                $this->getConfig()->getConfig()['doctrine']['is_dev_mode'],
                $this->getConfig()->getConfig()['doctrine']['proxy_dir'],
                $this->getConfig()->getConfig()['doctrine']['cache'],
                $this->getConfig()->getConfig()['doctrine']['use_simple_annotation_reader']
            );

            $this->entityManager = EntityManager::create(
                $this->getConfig()->getConfig()['doctrine']['connection'],
                $config)
            ;
        }

        return $this->entityManager;
    }
}
