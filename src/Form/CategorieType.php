<?php

namespace App\Form;

use App\Entity\Categorie\Categorie;
use App\Entity\Categorie\CategoriesImage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('image', EntityType::class, array(
                'class' => CategoriesImage::class,
                'choice_label' =>'imageName',
                'required' => false,
                'placeholder' => 'Choisissez une image'
            ))
            ->add('ajouter', SubmitType::class, array(
                'attr' => ['class' => 'waves-effect waves-light btn']
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class
        ]);
    }
}
