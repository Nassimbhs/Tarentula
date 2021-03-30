<?php

namespace App\Form;

use App\Entity\Produit;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('description',TextareaType::class)
            ->add('prix',TextType::class)
            ->add('fournisseur')
            ->add('image', FileType::class, ['mapped' => false])
            ->add('image1', FileType::class, ['mapped' => false])
            ->add('image2', FileType::class, ['mapped' => false])
            ->add('image3', FileType::class, ['mapped' => false])
            ->add('image4', FileType::class, ['mapped' => false])
        ;
    }
}
