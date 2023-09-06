<?php declare(strict_types=1);

/*
 * This file is part of the medicalmundi/oe-module-marketplace
 *
 * @copyright (c) Zerai Teclai <teclaizerai@gmail.com>.
 * @copyright (c) Francesca Bonadonna <francescabonadonna@gmail.com>.
 *
 * This software consists of voluntary contributions made by many individuals
 * {@link https://github.com/medicalmundi/oe-module-marketplace/graphs/contributors developer} and is licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * @license https://github.com/MedicalMundi/oe-module-marketplace/blob/main/LICENSE MIT
 */

namespace OpenEMR\Modules\Marketplace;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

final class Module
{
    public const MODULE_NAME = 'Modules Marketplace';

    public const MODULE_VERSION = 'v0.1.3';

    public const MODULE_SOURCE_CODE = 'https://github.com/medicalmundi/oe-module-marketplace';

    public const VENDOR_NAME = 'MedicalMundi';

    public const VENDOR_URL = 'https://github.com/medicalmundi';

    public const LICENSE = 'MIT';

    public const LICENSE_URL = 'https://github.com/medicalmundi/oe-module-marketplace/blob/main/LICENSE';

    /**
     * @var ContainerInterface
     *
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected $container;

    private function __construct()
    {
    }

    public static function bootstrap(): self
    {
        $module = new self();
        $container = $module->buildContainer();
        $module->container = $container;

        return $module;
    }

    private function buildContainer(): ContainerInterface
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->useAutowiring(true);
        //$containerBuilder->addDefinitions(__DIR__ . '/../config/di/monolog.php');
        $containerBuilder->addDefinitions(__DIR__ . '/../config/di/twig.php');
        $containerBuilder->addDefinitions(__DIR__ . '/../config/di/service.php');

        return $containerBuilder->build();
    }

    public static function isStandAlone(): bool
    {
        $interfaceRootDirectory = \dirname(__DIR__, 4);
        $openemrGlobalFile = $interfaceRootDirectory . DIRECTORY_SEPARATOR . "globals.php";
        return ! file_exists($openemrGlobalFile);
    }

    public static function mainDir(): string
    {
        return \dirname(__DIR__, 1);
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}
