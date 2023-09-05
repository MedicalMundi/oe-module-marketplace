<?php declare(strict_types=1);

/**
 * This file is required, see official guidelines.
 * The guide not clarifying the content and the supposed intent.
 *
 * @see pag. 15 - https://www.open-emr.org/wiki/images/6/61/ModuleInstaller-DeveloperGuide.pdf - custom module section.
 */

use Laminas\HttpHandlerRunner\Emitter\SapiStreamEmitter;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;


use OpenEMR\Modules\Marketplace\Adapter\Http\Web\AboutController;
use OpenEMR\Modules\Marketplace\Adapter\Http\Web\DefaultController;
use OpenEMR\Modules\Marketplace\Adapter\Http\Web\NotFoundController;
use OpenEMR\Modules\Marketplace\Finder\PackagistModuleFinder;
use OpenEMR\Modules\Marketplace\Module;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Twig\Environment;

require __DIR__ . '/../src/Module.php';

if (Module::isStandAlone()) {
    require __DIR__ . '/../vendor/autoload.php';
} else {
    require __DIR__ . '/../../../../../vendor/autoload.php';
}


$module = Module::bootstrap();

$psr17Factory = new Psr17Factory();
$serverRequestFactory = new ServerRequestCreator(
    $psr17Factory, // serverRequestFactory
    $psr17Factory, // uriFactory
    $psr17Factory, // uploadedFileFactory
    $psr17Factory // streamFactory
);

$request = $serverRequestFactory->fromGlobals();

/**
 * Integrating with Legacy Sessions here, if needed.
 */


$response = routerMatch($request, $module->getContainer());

(new SapiStreamEmitter())->emit($response);


/**
 *
 * Naive router
 */
function routerMatch(ServerRequestInterface $request, ContainerInterface $container): ResponseInterface
{
    if ($request->getUri()->getPath() === '/interface/modules/custom_modules/oe-module-marketplace/public/index.php' ||
        $request->getUri()->getPath() === '/interface/modules/custom_modules/oe-module-marketplace/public' ||
        $request->getUri()->getPath() === '/interface/modules/custom_modules/oe-module-marketplace/public/' ||
        $request->getUri()->getPath() === '/') {


        // TODO use container
        return (new DefaultController($container->get(PackagistModuleFinder::class), $container->get(Environment::class)))($request);
        //return ($container->get(DefaultController::class))($request);
    }

    if ($request->getUri()->getPath() === '/interface/modules/custom_modules/oe-module-marketplace/public/about') {

        return ($container->get(AboutController::class))();
    }

    return ($container->get(NotFoundController::class))();
}
