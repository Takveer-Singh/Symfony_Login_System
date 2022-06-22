<?php

namespace App\Controller;

use App\Entity\Students;
use App\Repository\StudentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentsController extends AbstractController
{
    private $emi;
    public function __construct(EntityManagerInterface $emi)
    {
        $this->emi =$emi;
    }

    #[Route('/student', name: 'student')]
    public function index(): Response
    {
        $repository = $this->emi->getRepository(Students::class);

        // findAll() add method
       // $student = $repository->findAll();

       // find() method
       // select * from student where id=2;
      // $student = $repository->find(2);

       // findBy() method
       // select * from student where ORDER BY id DESC;
      // $student = $repository->findBy([],['id'=>'DESC']);

       // findOneBy() method
       // select * from student where id=2 AND Name='Bhavya Bhatia' ORDER BY id DESC;
      // $student = $repository->findOneBy(['id'=>2,'Name'=>'Bhavya Bhatia'],['id'=>'DESC']);

       // count method
       // select COUNT() from movie WHERE id=1;
      // $student = $repository->count(['id'=>1]);

       // getClassName() method
       // get the entity name
       // $student = $repository->getClassName();

       // dump var
        // dd($student);

        return $this->render('number.html.twig');
    }

}