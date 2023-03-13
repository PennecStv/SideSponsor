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
            ->add('name', null, [
                'label' => "Nom",
                'attr' => array(
                    'placeholder' => "Nom du titulaire du contrat"
                )
            ])

            ->add('mecene_name', null, [
                'label' => "Nom du mécène",
                'attr' => array(
                    'placeholder' => "Nom de la personne ou de l'entreprise du sponsor"
                )
            ])

            ->add('begin_date',DateType::Class, array(
                'label' => "Date de début du contrat",
                'widget' => 'choice',
                'data' => new \DateTime(),
                'years' => range(date('Y')-20, date('Y')+20),
                'months' => range(1, 12),
                'days' => range(1, 31),
            ))

            ->add('end_date',DateType::Class, array(
                'label' => "Date de fin du contrat",
                'widget' => 'choice',
                'data' => new \DateTime(),
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
