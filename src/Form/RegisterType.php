<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de famille* :'
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom* :'
            ])
            ->add('email', EmailType::class , [
                'label'=> 'Email* :'
            ])
            ->add('plainPassword', RepeatedType::class,[
                'type' => PasswordType::class,
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe* :'],
                'second_options' => ['label' => 'Confirmation* :'],
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
            ])
            ->add('cgu', CheckboxType::class, [
                'mapped' => false,
                'label' => 'J\'accepte les CGU de Green Goodies.',
                'constraints' => [
                    new IsTrue(
                        message: 'Vous devez accepter les CGU de Green Goodies.',
            ),
    ],
]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
