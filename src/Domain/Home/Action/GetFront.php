<?php

declare(strict_types=1);

namespace App\Domain\Home\Action;

use App\Application\Common\Enum\HttpMethodEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class GetFront extends AbstractController
{
    #[Route('/', name: 'home', methods: HttpMethodEnum::GET->value)]
    public function indexAction(): Response
    {
        return $this->render('base.html.twig');
    }
}
