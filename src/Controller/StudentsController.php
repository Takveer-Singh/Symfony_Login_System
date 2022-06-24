<?php

namespace App\Controller;

use App\Entity\Students;
use App\Entity\Users;
use App\Form\StudentFormType;
use App\Repository\StudentsRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentsController extends AbstractController
{
    private $studentRepo;
    private $userRepo;
    private $em;
    public function __construct(StudentsRepository $studentRepo,UsersRepository $userRepo,EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->studentRepo = $studentRepo;
        $this->userRepo = $userRepo;
    }


    #[Route('/createstudent', name: 'createstudent')]
    public function create(Request $request): Response
    {
        $student = new Students();
        //$user=new Users();
       $form = $this->createForm(StudentFormType::class,$student);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
        $newStudent = $form->getData();

         $student->setAdmissionNumber($form->get('admission_number')->getdata());
         $student->setclassId($form->get('classId')->getdata());

        // CREATE USER DATA

        $user =new Users();
        $user->Setname($form->get('studentname')->getdata());
        $user->setRole('student');
        $user->setUserName('student');
        $user->setPassword(($form->get('studentname')->getdata()). "123");
        $user->setUserType('student');
         
        
        $this->em->persist($user);
        $this->em->flush();
         //
       

        $student->setUserId($user);
        $this->em->persist($student);
        $this->em->flush();
    
      
        return $this->redirectToRoute('createstudent');
      }
      $data =  $this->studentRepo->findAll();
    //   $RawQuery  = 'SELECT a.id, a.class_name, COUNT(c.id) AS Student_Count FROM classes a
    //   LEFT JOIN students c ON c.class_id_id = a.id
    //   GROUP BY a.id';
    //   $Classes = $this->studentRepo->RawQuery($RawQuery);

       return $this->render('addstudent.html.twig',[
        'form' => $form->createView(),
        'students' => $data,
       ]);
    }

    #[Route('/deletedata/{id}', name: 'deletedata')]
    public function DeleteClass($id)
    {
        $data =  $this->studentRepo->find($id);
        $this->studentRepo->remove($data);
        $this->em->flush();
        return $this->redirectToRoute('createstudent');
    }

    #[Route('/updatedata/{id}',name:'updatedata')]
    public function UpdateClass($id,Request $request)
    {
        $data =  $this->studentRepo->find($id);
        $form = $this->createForm(StudentFormType::class,$data);
        //$classesdata =  $this->classRepository->findAll();
        $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
         $data->setAdmissionNumber($form->get('ClassName')->getdata());
         $this->em->flush();
          return $this->redirectToRoute('createstudent');
      }
        return $this->render('addstudent.html.twig',[
        'form' => $form->createView(),
        'students' => $data,
       ]);
    }
}