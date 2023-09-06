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

namespace OpenEMR\Modules\Marketplace\Tests\Unit\Application;

use OpenEMR\Modules\Marketplace\Application\ModuleItem;
use OpenEMR\Modules\Marketplace\Application\PackagistItem;
use PHPUnit\Framework\TestCase;

class PackagistItemTest extends TestCase
{
    private const IRRELEVANT = 'irrelevant';

    /**
     * @test
     */
    public function can_be_created(): void
    {
        $packagistItem = PackagistItem::create(
            self::IRRELEVANT,
            self::IRRELEVANT,
            self::IRRELEVANT,
            self::IRRELEVANT,
            100
        );

        self::assertInstanceOf(ModuleItem::class, $packagistItem);
        self::assertInstanceOf(PackagistItem::class, $packagistItem);
        self::assertSame(self::IRRELEVANT, $packagistItem->getName());
        self::assertSame(self::IRRELEVANT, $packagistItem->getDescription());
        self::assertSame(self::IRRELEVANT, $packagistItem->getUrl());
        self::assertSame(self::IRRELEVANT, $packagistItem->getRepository());
        self::assertSame(100, $packagistItem->getDownloads());
    }
}
