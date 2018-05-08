<?php

namespace App\Form;

use App\Entity\Categorie\Categorie;
use App\Entity\Etude\Etude;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('texte', CKEditorType::class)
            ->add('categorie', EntityType::class, array(
                'choice_label' => 'nom',
                'class' => Categorie::class,
                'placeholder' => 'Choisissez une catégorie'
            ))
            ->add('valider', SubmitType::class, array(
                'attr' => ['class' => 'waves-effect waves-light btn']
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etude::class
        ]);
    }
}
