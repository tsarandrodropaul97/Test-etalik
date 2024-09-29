<?php

namespace App\Form;

use App\Entity\AttributesTypes;
use App\Entity\AttributesValues;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\WeekType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttributesValuesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $attributeType = $options['attribute_type'];

        switch ($attributeType) {
            case 'text':
                $builder->add('value', TextType::class, [
                    'label' => 'Veuillez saisir sur le champ',
                    'required' => false,
                    'attr' => ['class' => 'form-control'],
                ]);
                break;
            case 'textearea':
                $builder->add('value', TextareaType::class, [
                    'label' => 'Veuillez saisir sur le champ',
                    'required' => false,
                    'attr' => ['class' => 'form-control'],
                ]);
                break;

            case 'password':
                $builder->add('value', PasswordType::class, [
                    'label' => 'Veuillez saisir votre mot de passe',
                    'required' => false,
                    'attr' => ['class' => 'form-control'],
                ]);
                break;

            case 'email':
                $builder->add('value', EmailType::class, [
                    'label' => 'Veuillez saisir votre adresse e-mail',
                    'required' => false,
                    'attr' => ['class' => 'form-control'],
                ]);
                break;

            case 'number':
                $builder->add('value', IntegerType::class, [
                    'label' => 'Veuillez saisir un nombre',
                    'required' => false,
                    'attr' => ['class' => 'form-control'],
                ]);
                break;

            case 'tel':
                $builder->add('value', TelType::class, [
                    'label' => 'Veuillez saisir votre numéro de téléphone',
                    'required' => false,
                    'attr' => ['class' => 'form-control'],
                ]);
                break;

            case 'url':
                $builder->add('value', UrlType::class, [
                    'label' => 'Veuillez saisir une URL',
                    'required' => false,
                    'attr' => ['class' => 'form-control'],
                ]);
                break;

            case 'date':
                $builder->add('value', DateType::class, [
                    'label' => 'Veuillez sélectionner une date',
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'input' => 'string',  
                    'required' => false,
                    'attr' => ['class' => 'form-control'],
                ]);
                break;

            case 'week':
                $builder->add('value', WeekType::class, [
                    'label' => 'Veuillez sélectionner une semaine',
                    'required' => false,
                    'attr' => ['class' => 'form-control'],
                ]);
                break;

            case 'time':
                $builder->add('value', TimeType::class, [
                    'label' => 'Veuillez sélectionner une heure',
                    'widget' => 'single_text',
                    'required' => false,
                    'mapped' => false,
                    'attr' => ['class' => 'form-control'],
                ]);
                break;

            case 'color':
                $builder->add('value', ColorType::class, [
                    'label' => 'Veuillez choisir une couleur',
                    'required' => false,
                    'attr' => ['class' => 'form-control'],
                ]);
                break;

            case 'checkbox':
                $builder->add('value', CheckboxType::class, [
                    'label' => 'Veuillez cocher ce champ',
                    'required' => false,
                    'attr' => ['class' => 'form-check-input'],
                ]);
                break;

            case 'radio':
                $builder->add('value', ChoiceType::class, [
                    'label' => 'Veuillez faire un choix',
                    'choices' => [
                        'Option 1' => 'option1',
                        'Option 2' => 'option2',
                    ],
                    'expanded' => true,
                    'required' => false,
                    'attr' => ['class' => 'form-check-input'],
                ]);
                break;

            case 'file':
                $builder->add('value', FileType::class, [
                    'label' => 'Veuillez télécharger un fichier',
                    'required' => false,
                    'attr' => ['class' => 'form-control-file'],
                ]);
                break;

            case 'hidden':
                $builder->add('value', HiddenType::class, [
                    'mapped' => false,
                ]);
                break;

            case 'image':
                $builder->add('value', FileType::class, [
                    'label' => 'Veuillez télécharger une image',
                    'required' => false,
                    'attr' => ['accept' => 'image/*', 'class' => 'form-control-file'],
                ]);
                break;

            case 'submit':
                $builder->add('submit', SubmitType::class, [
                    'label' => 'Envoyer',
                    'attr' => ['class' => 'btn btn-primary'],
                ]);
                break;

            case 'reset':
                $builder->add('reset', ResetType::class, [
                    'label' => 'Réinitialiser',
                    'attr' => ['class' => 'btn btn-secondary'],
                ]);
                break;

            case 'button':
                $builder->add('button', ButtonType::class, [
                    'label' => 'Cliquez ici',
                    'attr' => ['class' => 'btn btn-info'],
                ]);
                break;

            default:
                throw new \InvalidArgumentException('Type d\'attribut non reconnu : ' . $attributeType);
        }



        // ->add('attributesType', EntityType::class, [
        //     'class' => AttributesTypes::class,
        //     'choice_label' => 'id',
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AttributesValues::class,
        ]);
        $resolver->setRequired('attribute_type');
    }
}
