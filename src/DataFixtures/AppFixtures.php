<?php

namespace App\DataFixtures;

use App\Entity\Detail;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $detail = new Detail();
        $detail->setQuantite('4');
        // $product = new Product();
        // $manager->persist($product);
        
        $manager->persist($detail);

        $manager->flush();
    }
}
