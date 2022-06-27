<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Employee;
use App\Form\EmployeeFormType;
use App\Repository\UserRepository;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployeeController extends AbstractController
{
    private $EmpRepo;
    private $em;
    public function __construct(EmployeeRepository $EmpRepo,UserRepository $userRepo,EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->EmpRepo = $EmpRepo;
        $this->userRepo = $userRepo;
    }


    #[Route('/createemployee', name: 'createemployee')]
    public function create(Request $request): Response
    {
        $employee = new Employee();
        //$user=new Users();
       $form = $this->createForm(EmployeeFormType::class,$employee);
       $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
        $employee->setEmployeeCode($form->get('employee_code')->getdata());
        $employee->setName($form->get('Name')->getdata());
         $employee->setRole($form->get('role')->getdata());
         $roles[] =$form->get('role')->getdata();
        // dd($array);
        // CREATE USER DATA

        $user =new User();
        $user->setUsername($form->get('Name')->getdata());
        $user->setRoles($roles);
        $user->setPassword(($form->get('Name')->getdata()). "123");
         
        
        $this->em->persist($user);
        $this->em->flush();
         //
       

        $employee->setUser($user);
        $this->em->persist($employee);
        $this->em->flush();
    
      
        return $this->redirectToRoute('createemployee');
      }
      $data =  $this->EmpRepo->findAll();
      $RawQuery= 'SELECT employee.id,employee.employee_code,employee.name ,employee.role,user.username AS username
        FROM user JOIN employee ON user.id=employee.user_id';
        $data = $this->EmpRepo->RawQuery($RawQuery);

        // dd($data);

       return $this->render('addemployee.html.twig',[
        'form' => $form->createView(),
        'employees' => $data,
       ]);
    }

    #[Route('/deleteemployee/{id}', name: 'deleteemployee')]
    public function DeleteClass($id)
    {
        $data =  $this->EmpRepo->find($id);
        $this->EmpRepo->remove($data);
        $this->em->flush();
        return $this->redirectToRoute('createemployee');
    }

    #[Route('/updatedata/{id}',name:'updatedata')]
    public function UpdateClass($id,Request $request)
    {
        $data =  $this->EmpRepo->find($id);
        $data =  $this->EmpRepo->FindEmployee();
        $form = $this->createForm(EmployeeFormType::class,$data);
       
        $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
         $data->setEmployeeCode($form->get('employee_code')->getdata());
         $this->em->flush();
          return $this->redirectToRoute('createemployee');
      }
        return $this->render('addemployee.html.twig',[
        'form' => $form->createView(),
        'employees' => $data,
       ]);
    }
}