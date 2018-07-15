<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 21/06/2018
 * Time: 14:16
 */

namespace App\Form;


use App\Entity\Commentaire\CommentaireActu;
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireActuType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texte', FroalaEditorType::class)
            ->add('envoyer', SubmitType::class, array(
                'attr' => ['class' => 'waves-effect waves-light btn']
            ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommentaireActu::class
        ]);
    }
}