<?php

namespace App\Controller\Web\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ReadCarItemController extends AbstractController
{
    public function __construct(private readonly Environment $twig)
    {

    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[Route('/car/{id}',
        name: 'app_car_item',
        requirements: [
            'id' => "\d+"
        ],
        methods: ['GET'])]
    public function __invoke(int $id, Request $request, CarRepository $carRepository): Response
    {
        $car = $carRepository->find($id);

        dump($car);

        //todo: gerer le cas des 404
        if ($car === null) {
            return $this->redirectToRoute('app_homepage');
        }


        $html = $this->twig->render('item/car-item.html.twig', [
            'car' => $car,
        ]);

        return new Response($html);
    }

}