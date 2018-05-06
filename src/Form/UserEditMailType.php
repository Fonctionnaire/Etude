<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 05/05/2018
 * Time: 18:01
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class UserEditMailType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('newEmail', EmailType::class)
            ->add('valider', SubmitType::class, array(
                'attr' => ['class' => 'waves-effect waves-light btn']
            ))
        ;
    }

}