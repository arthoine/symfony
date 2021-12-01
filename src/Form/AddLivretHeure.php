<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\User;
use App\Entity\LivretHeure;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Form\DatalistType;




class AddLivretHeure extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('user_id', EntityType::class, array(
                'class'    => User::class,
                'choice_label'  => 'username',
                'expanded' => false,
                'multiple' => false,
                'disabled'=> true

            ))
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'placeholder' => [
                    'year' => 'année', 'month' => 'Mois', 'day' => 'Jour',
                ],
                'data' => new \DateTime()

            ])


            ->add('id_client', EntityType::class, array(
                'class'    => Client::class,
                'choice_label'  => 'nom',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.actif = 1')
                        ->orderBy('u.Nom', 'ASC');
                },
                'required' => false,
                'expanded' => false,
                'multiple' => false,


            ))



            ->add('nbre_heure', ChoiceType::class, array(
                'choices'  => [
                    '8' => 8,
                    '6' => 6,
                    '4' => 4,
                    '2' => 2,
                    ],


            ))
            /*->add('ville', TextType::class, array(

            ))*/
            ->add('abs_maladie', CheckboxType::class, array(
                'required' => false,


            ))
            ->add('CP', CheckboxType::class, array(
                'required' => false,

            ))
            ->add('formation', CheckboxType::class, array(
                'required' => false,

             ));


    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults([
            'data_class' => LivretHeure::class,
        ]);
    }
}
