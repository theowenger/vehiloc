<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class createCarController extends AbstractController
{

    #[Route('/api/car/submit', name: 'api_submit_new_car', methods: ['POST'])]
    public function __invoke(): Response
    {
        return new Response('ok');
    }
}