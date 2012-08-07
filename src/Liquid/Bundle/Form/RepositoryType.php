<?php

namespace Liquid\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RepositoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url')
            ->add('author')
            ->add('condition')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Liquid\Bundle\Entity\Repository'
        ));
    }

    public function getName()
    {
        return 'liquid_bundle_repositorytype';
    }
}
