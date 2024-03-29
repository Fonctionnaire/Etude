<?php

namespace App\Form;

use App\Entity\Categorie\Categorie;
use App\Entity\Etude\Etude;
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array(
                'attr' => ['placeholder' => '200 caractères maximum.']
            ))
            ->add('texte', FroalaEditorType::class)
            ->add('categorie', EntityType::class, array(
                'choice_label' => 'nom',
                'class' => Categorie::class,
                'placeholder' => 'Choisissez une catégorie'
            ))
            ->add('sources', CollectionType::class, array(
                'entry_type' => SourceType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false,
                'by_reference' => false
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
