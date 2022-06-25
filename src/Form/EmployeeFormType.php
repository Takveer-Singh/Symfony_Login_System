<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('employee_code',IntegerType::class,[
                'attr'=>array(
                    'class'=>'form-control',
                    'style'=>'font-weight: 500;',
                    'placeholder'=>'Employee code'
                )])
            ->add('Name',TextType::class,[
                'attr'=>array(
                    'class'=>'form-control',
                    'style'=>'font-weight: 500;',
                    'placeholder'=>'Enter Name'
                )
            ])
            ->add('role',ChoiceType::class,[
                'choices' => [
                    'Teacher' => 'teacher',
                    'Admin' => 'admin',
                ],
                "mapped"=>false,
                'attr'=>array(
                    'class'=>'form-control',
                    'style'=>'font-weight: 500;margin-bottom:10px;',
                )
               ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
