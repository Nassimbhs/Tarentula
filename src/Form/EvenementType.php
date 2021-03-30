<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\TypeEvenement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,['label'=>'Nom ', 'attr'=>['placeholder'=>'merci de definir le nom','class'=>'nom',]])
            ->add('organisateur',TextType::class,['label'=>'organisateur ', 'attr'=>['placeholder'=>'merci de definir organisateur','class'=>'organisateur',]])
            ->add('lieu',TextType::class,['label'=>'lieu ', 'attr'=>['placeholder'=>'merci de definir le lieu','class'=>'lieu',]])
            ->add('date',DateType::class,['label'=>'date ', 'attr'=>['placeholder'=>'merci de definir la date','class'=>'date',]])
            //->add('type',ChoiceType::class,['label'=>'type ', 'attr'=>['placeholder'=>'merci de definir le type de evenement','class'=>'type',]]);
            ->add('type',EntityType::class,['class'=>TypeEvenement::class,'choice_label'=>'secteur'])
            ->add('image', FileType::class, array('label' => 'image','required' => false))
            ->add('note', ChoiceType::class, [
                'choices' => [
                    1=> 1 ,
                    2=> 2,
                    3=> 3,
                    4=> 4,5=> 5]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
