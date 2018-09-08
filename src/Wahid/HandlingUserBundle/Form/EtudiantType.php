<?php

namespace Wahid\HandlingUserBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Wahid\HandlingUserBundle\WahidHandlingUserBundle;

class EtudiantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('studentCardNumbers',IntegerType::class ,array('label'=>'Numéros carte étudiant :'))
            ->add('name',TextType::class,array('label'=>'Entrez votre nom : '))
            ->add('firstName',TextType::class, array('label'=>'Entrez votre prénom : '))
            ->add('datebirth',DateType::class,array('label'=>'Entrez votre date de naissance : '))
            ->add('media')
            ->add('section',EntityType::class,
                array('class'=>'Wahid\HandlingUserBundle\Entity\Section',
                    'choice_label'=>'name',
                    'multiple'=>false,
                    'label'=>'choisissez votre section : '
                ))
            ->add('cours',EntityType::class,
                array('class'=>'Wahid\HandlingUserBundle\Entity\Cours',
                    'choice_label'=>'name',
                    'multiple'=>true,
                    'label'=>'choisissez les cours : '
                ))
            ->add('comptesocials',CollectionType::class,
                array('entry_type'=>CompteSocialType::class,
                'allow_add'=>true,
                'allow_delete'=>true,
                'label'=>'Ajoutez vos comptes sociaux :  '
            ))
            ->add('Envoyer',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wahid\HandlingUserBundle\Entity\Etudiant'
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'wahid_handlinguserbundle_etudiant';
    }


}
