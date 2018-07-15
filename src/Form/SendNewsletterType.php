<?php

namespace App\Form;

use App\Entity\Newsletter\SendNewsletter;
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SendNewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texte', FroalaEditorType::class)
            ->add('valider', SubmitType::class, array(
                'attr' => ['class' => 'waves-effect waves-light btn']
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SendNewsletter::class,
        ]);
    }
}
