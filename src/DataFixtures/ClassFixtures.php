<?php

namespace App\DataFixtures;

use App\Entity\Classes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClassFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $class=new classes();
        $class->setClassName('A1');
        $manager->persist($class);

        $class1=new classes();
        $class1->setClassName('B1');
        $manager->persist($class1);

        $manager->flush();

        $this->addReference('class',$class);
        $this->addReference('class1',$class1);
    }
}
