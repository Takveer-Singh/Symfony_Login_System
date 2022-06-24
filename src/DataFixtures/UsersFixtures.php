<?php

namespace App\DataFixtures;

use App\Entity\Users;
use App\Entity\Students;
use App\Entity\classes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1=new Users();
        $user1->setUserName('Takveer');
        $user1->setName('tak');
        $user1->setPassword('Tak123');
        $user1->setRole('student');
        $user1->setUserType('student');
        $manager->persist($user1);
        $manager->flush();


        $class=new classes();
        $class->setClassName('A1');
        $manager->persist($class);
        $manager->flush();


        $student = new Students();
        $student->setAdmissionNumber(101);
        $student->setClassId($class);
        $student->setUserId($user1);
        $manager->persist($student);

        $manager->flush();
       
    }
}
