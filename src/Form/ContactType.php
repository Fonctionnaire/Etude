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

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class)
            ->add('email', EmailType::class, array(
                'attr' => ['placeholder' => 'Exemple : nom.prenom@gmail.com']
            ))
            ->add('sujet', TextType::class)
            ->add('texte', TextareaType::class)
            ->add('valider', SubmitType::class, array(
                'attr' => ['class' => 'waves-effect waves-light btn']
            ))
        ;
    }
}