<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 09/05/2018
 * Time: 16:36
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, array(
                'constraints' => array(new Length(array(
                    'min' => 2,
                    'minMessage' => 'Le pseudo doit comporter au moins 2 caractères.',
                    'max' => 15,
                    'maxMessage' => 'Le pseudo ne peut avoir plus de 15 caractères.'
                )),
                new NotBlank()
            )))
            ->add('email', EmailType::class, array(
                'attr' => ['placeholder' => 'Exemple : nom.prenom@gmail.com'],
                'constraints' => array(new Email(),
                new NotBlank()
            )))
            ->add('sujet', TextType::class, array(
                'attr' => ['placeholder' => '100 caractères maximum.'],
                'constraints' => array(new Length(array(
                    'min' => 2,
                    'minMessage' => 'Le sujet doit comporter au moins 2 caractères.',
                    'max' => 100,
                    'maxMessage' => 'Le sujet ne peut comporter plus de 100 caractères.'
                )),
                new NotBlank()

            )))
            ->add('texte', TextareaType::class, array(
                'constraints' => array(new Length(array(
                    'min' => 10,
                    'minMessage' => 'Le message doit comporter au moins 10 caractères.',
                    'max' => 1200,
                    'maxMessage' => 'Le message ne peut contenir plus de 1200 caractères.'
                )),
                new NotBlank()
            )))
            ->add('valider', SubmitType::class, array(
                'attr' => ['class' => 'waves-effect waves-light btn']
            ))
        ;
    }
}