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

namespace OpenEMR\Modules\Marketplace\Application;

use Doctrine\Common\Collections\ArrayCollection;
use Webmozart\Assert\Assert;

class PackagistItemCollection implements ModuleItemCollection
{
    /**
     * @var ArrayCollection <int,PackagistItem>
     */
    private $collection;

    /**
     * @param iterable <PackagistItem> $collection
     */
    public function __construct(iterable $collection = [])
    {
        Assert::allIsInstanceOf($collection, PackagistItem::class);
        $this->collection = new ArrayCollection((array) $collection);
    }

    public function count(): int
    {
        return $this->collection->count();
    }

    /**
     * @return array <PackagistItem>
     */
    public function getItems(): array
    {
        return $this->collection->toArray();
    }
}
