<?php

namespace App\Controller;

//use App\Entity\Classes;
//use App\Repository\ClassesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $emi;
    public function __construct(EntityManagerInterface $emi)
    {
        $this->emi =$emi;
    }

    #[Route('/employee', name: 'employee')]
    public function index(): Response
    {
        //$repository = $this->emi->getRepository(Classes::class);

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

        return $this->render('addemployee.html.twig');
    }

}