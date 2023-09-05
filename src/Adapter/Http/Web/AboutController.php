<?php declare(strict_types=1);

namespace OpenEMR\Modules\Marketplace\Adapter\Http\Web;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Twig\Environment;

class AboutController
{
    /**
     * @var Environment
     */
    private $twigEnvironment;

    public function __construct(Environment $twigEnvironment)
    {
        $this->twigEnvironment = $twigEnvironment;
    }

    public function __invoke(): ResponseInterface
    {
        $content = $this->twigEnvironment->render('about/index.html.twig');

        $psr17Factory = new Psr17Factory();
        $responseBody = $psr17Factory->createStream($content);

        return $psr17Factory->createResponse(200)->withBody($responseBody);
    }


}
