<?php

namespace App\Form;

use App\Entity\Diagnosis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Pathology;

class DiagnosisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datedia')
            ->add('pathologies',EntityType::class, [
            
                'class' => Pathology::class,
                 'multiple' => true,
                 'expanded' => true,
            ])
            ->add('paciente')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Diagnosis::class,
        ]);
    }
}
