<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

          $this->createCar($manager);


        $manager->flush();
    }

    private function createCar(ObjectManager $manager) : void
    {
        for($i = 0; $i < 10 ; $i++) {
        $car = new Car();
        $car->setName("Car number $i");
        $car->setDescription("description number $i");
        $car->setDailyPrice($i * 3);
        $car->setMonthlyPrice($i * 100);
        $car->setPlaces($i % 2 === 0 ? 3 : 5);
        $car->setManual($i % 2 === 0);

        $manager->persist($car);
        }
    }
}
