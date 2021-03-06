<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Students;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Admission_Number',IntegerType::class,[
                'attr'=>array(
                    'class'=>'form-control',
                    'style'=>'font-weight: 500;',
                    'placeholder'=>'Admission Number'
                )
            ])
            ->add('Name',TextType::class,[
                'attr'=>array(
                    'class'=>'form-control',
                    'style'=>'font-weight: 500;',
                    'placeholder'=>'Enter Name'
                )
            ])
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
            //->add('class')
            //->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Students::class,
        ]);
    }
}
