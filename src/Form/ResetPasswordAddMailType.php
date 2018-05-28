<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 27/05/2018
 * Time: 13:14
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ResetPasswordAddMailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('envoyer', SubmitType::class, array(
                'attr' => ['class' => 'waves-effect waves-light btn']
            ))
        ;
    }
}

