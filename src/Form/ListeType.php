<?php

namespace App\Form;

use App\Entity\Tache;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categorie')
            ->add('destinataire',EntityType::class,[
                    "class" =>User::class, // pris depuis l'entité, ne pas taper trop vite au clavier !!!
                    'choice_label'=>'email'
            ])
            ->add('titre')
            ->add('message')
            ->add('date', DateType ::class,[
                'widget'=>'single_text'])
            ->add('statut')
            ->add('confirmer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
    }
}
