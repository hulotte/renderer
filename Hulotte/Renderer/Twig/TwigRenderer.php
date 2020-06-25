<?php

namespace Hulotte\Renderer\Twig;

use Hulotte\Renderer\RendererInterface;
use Twig\{
    Environment,
    Error\LoaderError,
    Error\RuntimeError,
    Error\SyntaxError
};

/**
 * Class TwigRenderer
 * @author Sébastien CLEMENT <s.clement@la-taniere.net>
 * @package Hulotte\Renderer\Twig
 */
class TwigRenderer implements RendererInterface
{
    /**
     * @var Environment
     */
    private Environment $twig;

    /**
     * TwigRenderer constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @inheritDoc
     */
    public function addGlobal(string $key, $value): void
    {
        $this->twig->addGlobal($key, $value);
    }

    /**
     * @inheritDoc
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        $this->twig->getLoader()->addPath($path, $namespace);
    }

    /**
     * @return Environment
     */
    public function getTwig(): Environment
    {
        return $this->twig;
    }

    /**
     * @param string $view
     * @param array $params
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(string $view, array $params = []): string
    {
        return $this->twig->render($view . '.twig', $params);
    }
}
