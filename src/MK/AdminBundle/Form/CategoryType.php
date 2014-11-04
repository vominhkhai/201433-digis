<?php

namespace MK\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'category.form.name',
                'attr' => array(
                    'class' => 'form-control',
                )
            ));
    }
    
        /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MK\AdminBundle\Entity\Category',
            'translation_domain' => 'admin_messages'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'adminbundle_category';
    }
}
    