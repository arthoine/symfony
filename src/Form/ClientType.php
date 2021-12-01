<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Essence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;




class ClientType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('id_client', TextType::class, [
                'disabled'=> true
            ])
            ->add('nom', TextType::class, [
                'disabled'=> true
            ])
            ->add('adresse', TextType::class, [
                'disabled'=> true
            ])
            ->add('ville', TextType::class, [
                'disabled'=> true
            ])
            ->add('code_postal', TextType::class, [
                'disabled'=> true
            ])
            ->add('actif', CheckboxType::class, array(
                'required' => false,
            ))
        ;





    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
