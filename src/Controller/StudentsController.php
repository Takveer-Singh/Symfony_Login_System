<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Students;
use App\Form\StudentFormType;
use App\Form\RegistrationFormType;
use App\Repository\StudentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class StudentsController extends AbstractController
{
    private $studentRepo;
    private $em;
    public function __construct(StudentsRepository $studentRepo,EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->studentRepo = $studentRepo;
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

         //$student->setAdmissionNumber($form->get('admission_number')->getdata());
         $student->setclass($form->get('class')->getdata());

        // CREATE USER DATA

        $user =new User();
        //$user->Setname($form->get('studentname')->getdata());
        //$user->setRole('student');
        $user->setUsername($form->get('Name')->getdata());
        $user->setPassword(($form->get('Name')->getdata()). "123");
        // $user->setPassword(
        //     $userPasswordHasher->hashPassword(
        //             $user,
        //             $form->get('plainPassword')->getData()
        //         )
        //     );
        //$user->setUserType('student');
         
        
        $this->em->persist($user);
        $this->em->flush();
         //
       

        $student->setUser($user);
        $this->em->persist($student);
        $this->em->flush();
    
      
        return $this->redirectToRoute('createstudent');
      }
      $data =  $this->studentRepo->findAll();
      $RawQuery= 'SELECT students.id,students.class_id, students.admission_number,students.name ,user.username AS username,
        classes.class_name FROM user JOIN students ON user.id=students.user_id JOIN classes ON
        classes.id = students.class_id';
        $data = $this->studentRepo->RawQuery($RawQuery);

       return $this->render('addstudent.html.twig',[
        'form' => $form->createView(),
        'students' => $data,
       ]);
    }

    #[Route('/deletestudent/{id}', name: 'deletestudent')]
    public function DeleteClass($id)
    {
        $data =  $this->studentRepo->find($id);
        $this->studentRepo->remove($data);
        $this->em->flush();
        return $this->redirectToRoute('createstudent');
    }

    // #[Route('/updatestudent/{id}',name:'updatestudent')]
    // public function UpdateClass($id,Request $request)
    // {
    //     $data =  $this->studentRepo->find($id);
    //     $RawQuery = 'SELECT students.id,students.name, students.class_id,students.admission_number,
    //     classes.class_name FROM Classes JOIN Students ON classes.id = students.class_id';
    //     $data = $this->studentRepo->RawQuery($RawQuery);
    
    //     $form = $this->createForm(StudentFormType::class,$data);
    //     //$classesdata =  $this->classRepository->findAll();
    //     $form->handleRequest($request);
    //   if($form->isSubmitted() && $form->isValid())
    //   {
    //      $data->setAdmissionNumber($form->get('Admission_Number')->getdata());
    //      $data->setName($form->get('Name')->getdata());
    //      $data->setClass($form->get('class')->getdata());
    //     //  $data->setclassId($form->get('classId')->getdata());
    //      $this->em->flush();
    //       return $this->redirectToRoute('createstudent');
    //   }
    //     return $this->render('addstudent.html.twig',[
    //     'form' => $form->createView(),
    //     'students' => $data,
    //    ]);
    // }

    #[Route('/updatestudent/{id}',name:'updatestudent')]
    public function UpdateClass($id,Request $request)
    {
        $studentdata =  $this->studentRepo->find($id);
        
        $studentsdata =  $this->studentRepo->FindStudent();

        $form = $this->createForm(StudentFormType::class,$studentdata);
        $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid())
      {
         $studentdata->setAdmissionNumber($form->get('Admission_Number')->getdata());
         $this->em->flush();
          return $this->redirectToRoute('createstudent');
     
      }
        return $this->render('addstudent.html.twig',[
        'form' => $form->createView(),
        'students' => $studentsdata, 
       ]);
    }
}