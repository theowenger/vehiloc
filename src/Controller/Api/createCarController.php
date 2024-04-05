<?php

namespace App\Controller\Api;

use App\Entity\Car;
use App\Form\CarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;

class createCarController extends AbstractController
{

    /**
     */
    #[Route('/api/car/submit', name: 'api_submit_new_car', methods: ['POST'])]
    public function __invoke(
        Request $request,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        FlashBagInterface $flashBag
    ): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        // On vérifie sa validité
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($car);
            $entityManager->flush();
            return $this->redirectToRoute('app_car_item', ['id' => $car->getId()]);
        }

        foreach ($form->getErrors(true) as $error) {
            $flashBag->add('error', $error->getMessage());
        }

        return $this->redirectToRoute('app_add_car');
    }
}