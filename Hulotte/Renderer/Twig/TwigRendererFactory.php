<?php

namespace Hulotte\Renderer\Twig;

use Twig\{
    Environment,
    Extension\AbstractExtension,
    Loader\FilesystemLoader
};

/**
 * Class TwigRendererFactory
 * @author Sébastien CLEMENT <s.clement@la-taniere.net>
 * @package Hulotte\Renderer\Twig
 */
class TwigRendererFactory
{
    /**
     * @param string $viewPath
     * @param string $env
     * @param AbstractExtension[]|null
     * @return TwigRenderer
     */
    public function __invoke(string $viewPath, string $env, ?array $extensions = null): TwigRenderer
    {
        $debug = $env !== 'prod';
        $loader = new FilesystemLoader($viewPath);
        $twig = new Environment($loader, [
            'debug' => $debug,
            'cache' => $debug ? false : 'tmp/views',
            'auto_reload' => $debug,
        ]);

        if ($extensions) {
            foreach ($extensions as $extension) {
                $twig->addExtension($extension);
            }
        }

        return new TwigRenderer($twig);
    }
}
