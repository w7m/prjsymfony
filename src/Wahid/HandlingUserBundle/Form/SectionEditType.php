<?php

namespace Wahid\HandlingUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SectionEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->remove('Envoyer')
                ->add('Modifier',SubmitType::class);

    }/**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return SectionType::class;
    }

}
