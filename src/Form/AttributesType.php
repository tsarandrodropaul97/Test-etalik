<?php

namespace App\Form;

use App\Entity\AttributesTypes;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttributesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', null, [
                'label' => 'Libellé',
                'attr' => [
                    'placeholder' => 'Entrer votre libellé',
                    'class' => 'form-control'
                ]
            ])
            ->add('dataType', HiddenType::class, [
                'attr' => ['class' => 'hidden-field'],
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'attr' => [
                    'class' => 'form-control',
                ],
                'placeholder' => 'Veuillez sélectionner',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AttributesTypes::class,
        ]);
    }
}
