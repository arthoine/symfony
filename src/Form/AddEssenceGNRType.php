<?php

namespace App\Form;

use App\Entity\EssenceGNR;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;




class AddEssenceGNRType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('volume', IntegerType::class, [



            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'placeholder' => [
                    'year' => 'année', 'month' => 'Mois', 'day' => 'Jour',
                ],
                'data' => new \DateTime()

            ])


            ->add('vehicule', EntityType::class, array(
                'class'    => 'App\Entity\Vehicule2',
                'choice_label'  => 'namevehicule',
                'expanded' => false,
                'multiple' => false,
            ))



            ->add('user', EntityType::class, array(
                'class'    => 'App\Entity\User',
                'choice_label'  => 'username',
                'expanded' => false,
                'multiple' => false,
                'disabled'=> true

            ))



        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EssenceGNR::class,
        ]);
    }
}
