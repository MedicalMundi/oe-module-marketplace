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

class PackagistItem implements ModuleItem
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $repository;

    /**
     * @var int
     */
    private $downloads;

    private function __construct(string $name, string $description, string $url, string $repository, int $downloads)
    {
        $this->name = $name;
        $this->description = $description;
        $this->url = $url;
        $this->repository = $repository;
        $this->downloads = $downloads;
    }

    public static function create(string $name, string $description, string $url, string $repository, int $downloads): self
    {
        return new self($name, $description, $url, $repository, $downloads);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getRepository(): string
    {
        return $this->repository;
    }

    public function getDownloads(): int
    {
        return $this->downloads;
    }
}
