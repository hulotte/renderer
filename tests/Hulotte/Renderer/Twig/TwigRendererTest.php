<?php

namespace tests\Hulotte\Renderer\Twig;

use Hulotte\Renderer\Twig\TwigRendererFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class TwigRendererTest
 * @author Sébastien CLEMENT <s.clement@la-taniere.net>
 * @covers \Hulotte\Renderer\Twig\TwigRenderer
 * @package tests\Hulotte\Renderer\Twig
 */
class TwigRendererTest extends TestCase
{
    /**
     * @var TwigRendererFactory
     */
    private $factory;

    /**
     * @covers \Hulotte\Renderer\Twig\TwigRenderer::render
     * @test
     */
    public function render(): void
    {
        $twig = ($this->factory)('./tests/views', 'dev');
        $result = preg_replace('/\s+/', '', $twig->render('test'));

        $this->assertSame('<h1>Test</h1>', $result);
    }

    /**
     * @covers \Hulotte\Renderer\Twig\TwigRenderer::render
     * @test
     */
    public function renderProd(): void
    {
        $twig = ($this->factory)('./tests/views', 'prod');
        $twig->render('test');

        $this->assertFileExists('./tmp/views');
    }

    protected function setUp(): void
    {
        $this->factory = new TwigRendererFactory;
    }

    protected function tearDown(): void
    {
        if(file_exists('./tmp')){
            $this->deleteFile('./tmp');
        }
    }

    /**
     * @param string $folder
     */
    private function deleteFile(string $folder): void
    {
        foreach(scandir($folder) as $file)
        {
            if($file === '.' || $file === '..'){
                continue;
            }

            if (is_dir($folder . '/' . $file)){
                $this->deleteFile($folder . '/' . $file);
            } else {
                unlink($folder . '/' . $file);
            }
        }

        rmdir($folder);
    }
}
