<?php declare(strict_types=1);

use Http\Discovery\HttpClientDiscovery;
use OpenEMR\Modules\Marketplace\Adapter\PackagistFinder\PackagistModuleFinder;
use OpenEMR\Modules\Marketplace\Adapter\Http\Web\DefaultController;
use OpenEMR\Modules\Marketplace\Adapter\Http\Web\NotFoundController;
use OpenEMR\Modules\Marketplace\Application\ModuleFinder;
use Twig\Environment;


return [
    PackagistModuleFinder::class => DI\create()
        ->constructor(DI\factory([HttpClientDiscovery::class, 'find'])),

    ModuleFinder::class => DI\create(PackagistModuleFinder::class),

    DefaultController::class => DI\create()
        ->constructor(DI\get(ModuleFinder::class), DI\get(Environment::class)),

    NotFoundController::class => new NotFoundController(),
];
