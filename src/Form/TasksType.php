<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Tasks;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TasksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('priority', ChoiceType::class, [
                "choices" => [
                    "Normale" => "P_NORMALE",
                    "Urgente" => "P_URGENTE"
                ]
            ])
            ->add('status', ChoiceType::class, [
                "choices" => [
                    "A faire" => "S_A_FAIRE",
                    "En cours" => "S_EN_COURS",
                    "Réalisée" => "S_DONE"
                ]
                ])
            ->add('date_end', DateTimeType::class)
            // ->add('projects', EntityType::class, [
            //     'class' => Projects::class])
            ->add('userTask', EntityType::class, [
                'class' => User::class,
                'multiple' => true,
                'expanded' => true  // Mapped true afin d'attribuer un ou plusieurs User à une tache           
                ])
            ->add('Ajouter', SubmitType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tasks::class,
        ]);
    }
}
