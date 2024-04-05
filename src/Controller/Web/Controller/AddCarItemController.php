<?php

namespace App\Controller\Web\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class AddCarItemController extends AbstractController
{
    public function __construct(private readonly Environment $twig)
    {

    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[Route('/car/add', name: 'app_add_car', methods: ['GET'])]
    public function __invoke(Request $request, CarRepository $carRepository) : Response
    {
        $car = new Car();
        /** @var FormFactoryInterface $form */
        $form = $this->createForm(CarType::class, $car);
        $formView = $form->createView();

        $html = $this->twig->render('misc/car-add.html.twig', [
            'form' => $formView,
        ]);

        return new Response($html);
    }

}