<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Classes;
use App\Entity\Students;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class StudentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('admission_number')
            ->add('studentname',TextType::class,  array("mapped"=>false, "data"=>2, "label"=>false))
            
            ->add('classId', EntityType::class,[
                'class' => Classes::class,
                'mapped' =>true,
                'choice_label' => function($choice){
                    return $choice->getClassName();
                },
                // 'choice_value' => function($choice){
                //     return $choice;
                // },
                'attr' => array(
                    'class' => 'mt-1 form-control'
                )
            ]);
        ;
    }

    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Students::class,
        ]);
    }
}
