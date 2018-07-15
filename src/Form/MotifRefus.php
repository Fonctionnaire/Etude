<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 09/05/2018
 * Time: 16:36
 */

namespace App\Form;

use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class MotifRefus extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('motifRefus', FroalaEditorType::class)
            ->add('valider', SubmitType::class, array(
                'attr' => ['class' => 'waves-effect waves-light btn']
            ))
        ;
    }
}