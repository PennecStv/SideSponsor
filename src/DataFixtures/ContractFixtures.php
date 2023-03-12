<?php

namespace App\DataFixtures;

use App\Entity\Contract;
use App\Form\ContractType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContractFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $contract = new Contract();
            $contract->setName($faker->name);
            $contract->setMeceneName($faker->company);
            $contract->setBeginDate($faker->dateTimeBetween("-5 years", " now"));
            $contract->setEndDate($faker->dateTimeBetween("now", "5 years"));

            $manager->persist($contract);
        }
        $manager->flush();
    }
}
