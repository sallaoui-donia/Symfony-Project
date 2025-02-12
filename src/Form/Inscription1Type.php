<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Inscription1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_enfant')
            ->add('prenom_enfant')
            ->add('nom_parent')
            ->add('telephone_parent')
            ->add('date_naissance')
            ->add('user')
            ->add('club')
            ->add('formation')
            ->add('camping')
            ->add('event')
            ->add('randonne')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
