<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Attendances;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttendanceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date',TextType::class,[
                'attr'=>array(
                    'class'=>'form-control',
                    'style'=>'font-weight: 500;',
                    'placeholder'=>'Enter Class'
                )
            ])

            ->add('status',ChoiceType::class,[
                'choices' => [
                    'present' => 'present',
                    'absent' => 'absent',
                ],
                "mapped"=>false,
                'attr'=>array(
                    'class'=>'form-control',
                    'style'=>'font-weight: 500;margin-bottom:10px;',
                )
               ])
            // ->add('student')
            ->add('class', EntityType::class,[
                'class'=> Classes::class,
                'mapped' =>true,
                'choice_label' => function($choice){
                    return $choice->getClassName();
                },
                'attr' => array(
                    'class' => 'form-control',
                    'style'=>'font-weight: 500;',
                    'label'=>'Student Class'
                )
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Attendances::class,
        ]);
    }
}
