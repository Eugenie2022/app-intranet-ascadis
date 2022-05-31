<?php

namespace App\Form;

use App\Entity\AccesPortail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class AccesPortailType extends AbstractType
{
    protected $auth;

    public function __construct(AuthorizationCheckerInterface $auth) {
        $this->auth = $auth;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($this->auth->isGranted('ROLE_ADMIN'))
        {
            $builder
                ->add('nom')
                ->add('login', null, [
                    'label' => "Login",
                ])
                ->add('password',null,[
                    'label' => 'Mot de passe'
                ])

                ->add('description')
                ->add('role',ChoiceType::class, [
                    'label' => 'Rôle',
                    'choices' => [
                        'Administrateur' => 'ROLE_ADMIN',
                        'Directeur' => 'ROLE_DIRECTEUR',
                        'Utilisateur' => 'ROLE_USER',
                    ],
                ]);
        }else if ($this->auth->isGranted('ROLE_DIRECTION'))
        {
            $builder
                ->add('nom')
                ->add('login', null, [
                    'label' => "Login",
                ])
                ->add('password',null,[
                    'label' => 'Mot de passe'
                ])

                ->add('description')
                ->add('role',ChoiceType::class, [
                    'label' => 'Rôle',
                    'choices' => [
                        'Directeur' => 'ROLE_DIRECTEUR',
                        'Utilisateur' => 'ROLE_USER',
                    ],
                ]);
        }else if ($this->auth->isGranted('ROLE_USER'))
        {
            $builder
                ->add('nom')
                ->add('login', null, [
                    'label' => "Login",
                ])
                ->add('password',null,[
                    'label' => 'Mot de passe'
                ])

                ->add('description')
                ->add('role',ChoiceType::class, [
                    'label' => 'Rôle',
                    'choices' => [
                        'Utilisateur' => 'ROLE_USER',
                    ],
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AccesPortail::class,
            'user' => null,

        ]);
    }
}
