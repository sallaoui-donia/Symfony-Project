<?php

namespace App\Form;

use App\Entity\Camping;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom_c')
            ->add('program')
            ->add('date_fin')
            ->add('date_debut')
            ->add('destination')
            ->add('nbrplaces')
            ->add('nbrbus')
            ->add('prix_c')




         
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Camping::class,
        ]);
    }
}
