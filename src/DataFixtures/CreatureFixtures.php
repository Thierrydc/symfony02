<?php

namespace App\DataFixtures;

use App\Entity\Creature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CreatureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $creature1 = new Creature();
        $creature1->setNom('doby')
            ->setDescription('le monstre dans Harry Potter')
            ->setImage('doby.jpg')
        ;
        $manager->persist($creature1);

        $creature2 = new Creature();
        $creature2->setNom('predator')
            ->setDescription('le monstre dans Predator')
            ->setImage('predator.jpg')
        ;
        $manager->persist($creature2);

        $creature3 = new Creature();
        $creature3->setNom('shrek')
            ->setDescription('le monstre dans shrek')
            ->setImage('shrek.jpg')
        ;
        $manager->persist($creature3);

        $creature4 = new Creature();
        $creature4->setNom('demogorgon')
            ->setDescription('le monstre dans Stranger Things')
            ->setImage('demogorgon.jpg')
        ;
        $manager->persist($creature4);

        $manager->flush();
    }
}
