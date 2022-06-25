<?php

namespace App\Controller;

use App\Entity\Classes;
use App\Form\ClassFormType;
use App\Repository\ClassesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassController extends AbstractController
{
    private $classRepository;
    private $em;
    public function __construct(ClassesRepository $classRepository,EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->classRepository = $classRepository;
    }

    // #[Route('/classes', methods: ['GET'], name: 'classes')]
    // public function index(): Response
    // {
    //     $classes = $this->classRepository->findAll();

    //     return $this->render('addclass.html.twig',[
    //         'classes' =>$classes
    //     ]);
    // }

    // #[route('/create',name: 'create')]
    // public function create(): Response
    // {
    //     $classcreate = new Classes();
    //     $form =$this->createForm(ClassFormType::class,$classcreate);

    //     return $this->render('addclass.html.twig',[
    //         'form'=>$form->createView()
    //     ]);
    // }


    #[Route('/class/{id}', methods: ['GET'], name: 'class')]
    public function show($id): Response
    {
        $class = $this->classRepository->find($id);

        return $this->render('showclass.html.twig',[
            'class' =>$class
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request): Response
    {
        $class = new Classes();
       $form = $this->createForm(ClassFormType::class,$class);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
        $newClass = $form->getData();
        $this->em->persist($newClass);
        $this->em->flush();
        return $this->redirectToRoute('create');
      }
      //$classesdata =  $this->classRepository->findAll();
      $RawQuery  = 'SELECT a.id, a.class_name, COUNT(c.id) AS Student_Count FROM classes a
      LEFT JOIN students c ON c.class_id = a.id
      GROUP BY a.id';
      $Classes = $this->classRepository->RawQuery($RawQuery);

       return $this->render('addclass.html.twig',[
        'form' => $form->createView(),
        'classes' => $Classes,
       ]);
    }

    #[Route('/deleteclass/{id}', name: 'deleteclass')]
    public function DeleteClass($id)
    {
        $classdata =  $this->classRepository->find($id);
        $this->classRepository->remove($classdata);
        $this->em->flush();
        return $this->redirectToRoute('create');
    }

    #[Route('/updateClassdata/{id}',name:'updateClassdata')]
    public function UpdateClass($id,Request $request)
    {
        $classdata =  $this->classRepository->find($id);
        $form = $this->createForm(ClassFormType::class,$classdata);
        //$classesdata =  $this->classRepository->findAll();
        $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
         $classdata->setClassName($form->get('ClassName')->getdata());
         $this->em->flush();
          return $this->redirectToRoute('create');
      }
        return $this->render('addclass.html.twig',[
        'form' => $form->createView(),
        'classes' => $classdata,
       ]);
    }

    
}