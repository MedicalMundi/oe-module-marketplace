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

namespace OpenEMR\Modules\Marketplace\Tests\Unit\Adapter\PackagistFinder;

trait PackagistHttpResponseTrait
{
    private function packagistEmptyResponseContent(): string
    {
        return <<<JSON
{
  "results": [],
  "total": 0
}
JSON;
    }

    private function packagistDefaultSingleResultResponseContent(): string
    {
        return <<<JSON
{
  "results": [
    {
      "name": "openemr/oe-module-faxsms",
      "description": "OpenEMR Fax and SMS module",
      "url": "https://packagist.org/packages/openemr/oe-module-faxsms",
      "repository": "https://github.com/openemr/oe-module-faxsms",
      "downloads": 36,
      "favers": 1
    }
  ],
  "total": 1
}
JSON;
    }

    private function packagistDefaultMultipleResultResponseContent(): string
    {
        return <<<JSON
{
  "results": [
    {
      "name": "zerai/oe-module-demo-farm-add-ons",
      "description": "OpenEMR Demo Farm Add-ons module",
      "url": "https://packagist.org/packages/zerai/oe-module-demo-farm-add-ons",
      "repository": "https://github.com/zerai/oe-module-demo-farm-add-ons",
      "downloads": 7,
      "favers": 0
    },
    {
      "name": "openemr/oe-module-faxsms",
      "description": "OpenEMR Fax and SMS module",
      "url": "https://packagist.org/packages/openemr/oe-module-faxsms",
      "repository": "https://github.com/openemr/oe-module-faxsms",
      "downloads": 36,
      "favers": 1
    }
  ],
  "total": 2
}
JSON;
    }

    private function packagistEmptyResultResponseContent(): string
    {
        return <<<JSON
{
  "results": [],
  "total": 0
}
JSON;
    }
}
