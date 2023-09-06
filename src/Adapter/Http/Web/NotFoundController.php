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
use Psr\Http\Message\ResponseInterface;

class NotFoundController
{
    public function __invoke(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();
        $responseBody = $psr17Factory->createStream($this->content());

        return $psr17Factory->createResponse(200)->withBody($responseBody);
    }

    private function content(): string
    {
        return '
            <!DOCTYPE html>
                <html>
                <head>
                    <title>Modules Marketplace - Not Found</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    
                    
                </head>
                <body>
                    <div class="container-fluid main-container" style="margin-top:50px">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-md-offset-1 content">
                                <h3>
                                    404 Page Not Found.
                                    
                                </h3>
                                
                                <a href="/interface/modules/custom_modules/oe-module-marketplace/index.php">back to index</a>
                            </div>
                        </div>
                    </div>
                </body>
                </html>
        ';
    }
}
