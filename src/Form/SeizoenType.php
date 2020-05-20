<?php

namespace App\Form;

use App\Entity\Seizoen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeizoenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('omschrijving')
            ->add('beginddatum')
            ->add('einddatum')
            ->add('korting')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Seizoen::class,
        ]);
    }
}
