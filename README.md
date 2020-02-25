# Hulotte Renderer
## Description
Hulotte Renderer is package to manage template and views with Twig.

## Installation
The easiest way to install Hulotte Renderer is to use 
[Composer](https://getcomposer.org/) with this command : 

```bash
$ composer require hulotte/renderer
```

## How to use Twig with Hulotte Renderer ?
To simplify the use of Twig, Hulotte Renderer has a factory.

```php
$viewPath = './views';
$environment = 'dev'; // can also be 'prod'
$extensions = [
    new TwigExtension1(),
    new TwigExtension2(),
]; // can be nullable

$twigFactory = new \Hulotte\Renderer\Twig\TwigRendererFactory;
$twig = $twigFactory($viewPath, $environment, $extensions);
```

Now you can render a view. If your view file is "/index.html.twig" :

```php
$twig->render('/index.html');
```

And if you have parameters to send to the view : 

```php
$twig->render('/index.html', ['param1' => 'hello', 'param2' => 'world']);
```
