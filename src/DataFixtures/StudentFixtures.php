<?php

namespace App\DataFixtures;

use App\Entity\Students;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $student = new Students();
        $student->setName('Takveer singh');
        $student->setAdmissionNumber(101);
        $manager->persist($student);
        $student->setClassId($this->getReference('class'));

        $student = new Students();
        $student->setName('Bhavya Bhatia');
        $student->setAdmissionNumber(102);
        $manager->persist($student);
        $student->setClassId($this->getReference('class1'));
       

        $manager->flush();
    }
}
