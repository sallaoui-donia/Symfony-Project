<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('password' ,PasswordType::class)
            ->add('confirm_password',PasswordType::class)
            ->add('roles',ChoiceType::class,[
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Gerant' => 'ROLE_EDITOR',

                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Rôles'
            ]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
