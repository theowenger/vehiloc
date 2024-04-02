<?php

namespace App\Controller\Web\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomepageController extends AbstractController
{
    public function __construct(private readonly Environment $twig)
    {

    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[Route('/', name: 'app_homepage', methods: ['GET'])]
    public function __invoke(Request $request, CarRepository $carRepository) : Response
    {

        $cars = $carRepository->findAll();

        $html = $this->twig->render('misc/homepage.html.twig', [
            'banner' => true,
            'cars' => $cars
        ]);

        return new Response($html);
    }

}