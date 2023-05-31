<?php

namespace App\Form;

use App\Entity\Plat;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                'attr' => [
                    'form-control',
                    'minlength' => '2',
                    'maxlength' => '250'
                ],
                'label' => 'Libelle',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('description')
            ->add('prix')
            ->add('image', FileType::class, [
                'label' => false,
                'mapped' => false,
                'required' => false
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => "libelle"

            ])
            ->add('active')
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'],
                    'label' => 'Valider'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
