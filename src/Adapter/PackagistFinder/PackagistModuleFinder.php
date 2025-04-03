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

namespace OpenEMR\Modules\Marketplace\Adapter\PackagistFinder;

use GuzzleHttp\Psr7\Request;
use Http\Client\HttpClient;
use OpenEMR\Modules\Marketplace\Application\ModuleFinder;
use OpenEMR\Modules\Marketplace\Application\ModuleItemCollection;
use OpenEMR\Modules\Marketplace\Application\PackagistItem;
use OpenEMR\Modules\Marketplace\Application\PackagistItemCollection;
use RuntimeException;

class PackagistModuleFinder implements ModuleFinder
{
    private const HOST = 'packagist.org';

    /**
     * @var HttpClient
     */
    private $httpClient;

    public function __construct(HttpClient $httpClient = null)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return PackagistItemCollection
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function searchModule(string $queryString = ''): ModuleItemCollection
    {
        $endpoint = $this->endpoint($queryString);
        $jsonResponse = $this->doSend($endpoint);
        $decodedResponse = json_decode($jsonResponse, true, 512, JSON_THROW_ON_ERROR);
        $itemsFromResponse = $decodedResponse['results'];

        return $this->buildCollection($itemsFromResponse);
    }

    public function endpoint(string $queryString = ''): string
    {
        return \sprintf('https://%s/search.json?q=%s&type=openemr-module', self::HOST, $queryString);
    }

    /**
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    private function doSend(string $httpEndpoint): string
    {
        $response = $this->httpClient->sendRequest(
            new Request(
                'GET',
                $httpEndpoint
            )
        );

        if (200 !== $response->getStatusCode()) {
            // TODO improve exception handeling - see php-http doc.
            throw new RuntimeException('Http error.');
        }

        return $response->getBody()->getContents();
    }

    /**
     * @param iterable<array> $itemsFromResponse
     */
    private function buildCollection(iterable $itemsFromResponse): PackagistItemCollection
    {
        $packagistItems = [];

        foreach ($itemsFromResponse as $item) {
            $packagistItems[] = PackagistItem::create($item['name'], $item['description'], $item['url'], $item['repository'], $item['downloads']);
        }

        return new PackagistItemCollection($packagistItems);
    }
}
