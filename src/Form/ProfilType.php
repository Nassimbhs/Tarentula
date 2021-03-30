<?php

namespace App\Form;

use App\Entity\Profil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nationalite')
            ->add('competence')
            ->add('dernierDiplome')
            ->add('dateObtention')
            ->add('dernierEmploi')
            ->add('domaineActivite')
            ->add('poste')
            ->add('descriptionPoste')
            ->add('dateFin')
            ->add('langue')
            ->add('niveauLangue')
            ->add('pays')
            ->add('region')
            ->add('ville')
            ->add('descPersonnelle')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
        ]);
    }
}
