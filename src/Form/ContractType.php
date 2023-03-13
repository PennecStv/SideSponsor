<?php

namespace App\Form;

use App\Entity\Contract;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContractType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')

            ->add('mecene_name')

            ->add('begin_date',DateType::Class, array(
                'widget' => 'choice',
                'years' => range(date('Y')-20, date('Y')+20),
                'months' => range(1, 12),
                'days' => range(1, 31),
            ))

            ->add('end_date',DateType::Class, array(
                'widget' => 'choice',
                'years' => range(date('Y')-20, date('Y')+20),
                'months' => range(1, 12),
                'days' => range(1, 31),
            ))


            ->add('Ajouter_le_contrat', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contract::class,
        ]);
    }
}
