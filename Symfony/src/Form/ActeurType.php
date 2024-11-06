<?php

namespace App\Form;

use App\Entity\Acteur;
use App\Entity\Film;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_acteur')
            ->add('Nom')
            ->add('Prenom')
            ->add('roleA')
            ->add('datenaissance', null, [
                'widget' => 'single_text',
            ])
            ->add('id_film', EntityType::class, [
                'class' => Film::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Acteur::class,
        ]);
    }
}
