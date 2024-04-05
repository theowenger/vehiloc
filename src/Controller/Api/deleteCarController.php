<?php

namespace App\Controller\Api;

use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class deleteCarController extends AbstractController
{
    public function __construct(
        private readonly CarRepository          $carRepository,
        private readonly EntityManagerInterface $entityManager,
    )
    {

    }
    #[Route('/car/{id}/delete', name: 'app_car_delete')]
    public function __invoke(int $id): Response
    {
        $car = $this->carRepository->find($id);

        if(!$car) {
            return $this->redirectToRoute('app_homepage');
        }

        $this->entityManager->remove($car);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_homepage');
    }
}