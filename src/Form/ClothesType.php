<?php

namespace App\Form;

use App\Entity\Clothes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClothesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('size')
            ->add('price')
            ->add('slug')
            ->add('isSold')
            ->add('file')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clothes::class,
            // Translate dashboard's label language
            'translation_domain' => 'forms'
        ]);
    }

    public function getChoices() 
    {
        $clothes = new Clothes();
        $choices = $clothes->getSlug();

        return $choices;
    }
}
