<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 21/06/2018
 * Time: 14:16
 */

namespace App\Form;


use App\Entity\Commentaire\CommentaireEtude;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class CommentaireEtudeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texte', CKEditorType::class, array(
                'constraints' => array(
                    new Length(array(
                        'max' => 1200,
                            'maxMessage' => 'Votre message ne peut dépacer 1200 caractères.'
                        )
                    )
                ),
            ))
            ->add('envoyer', SubmitType::class, array(
                'attr' => ['class' => 'waves-effect waves-light btn']
            ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommentaireEtude::class
        ]);
    }
}