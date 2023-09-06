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

namespace OpenEMR\Modules\Marketplace\Adapter\Http\Web;

use Nyholm\Psr7\Factory\Psr17Factory;
use OpenEMR\Modules\Marketplace\Application\ModuleFinder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

class DefaultController
{
    /**
     * @var ModuleFinder
     */
    private $moduleFinder;

    /**
     * @var Environment
     */
    private $twigEnvironment;

    public function __construct(ModuleFinder $moduleFinder, Environment $twigEnvironment)
    {
        $this->moduleFinder = $moduleFinder;
        $this->twigEnvironment = $twigEnvironment;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getParsedBody() !== null) {
            $searchTerm = $request->getParsedBody()['searchTerm'];
        } else {
            $searchTerm = '';
        }

        try {
            $collection = $this->moduleFinder->searchModule($searchTerm)->getItems();
            $content = $this->twigEnvironment->render('packagist/default.html.twig', [
                'items' => $collection,
                'searchTerm' => $searchTerm,
            ]);
        } catch (\Exception $exception) {
            //TODO
        }

        $psr17Factory = new Psr17Factory();
        $responseBody = $psr17Factory->createStream($content);

        return $psr17Factory->createResponse(200)->withBody($responseBody);
    }
}
