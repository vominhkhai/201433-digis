<?php

namespace MK\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductColorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'product.color.form.name',
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('color', null, array(
                'label' => 'product.color.form.color',
                'attr' => array(
                    'class' => 'form-control colorpicker-element  my-colorpicker1',
                )
            ));
    }
    
        /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MK\AdminBundle\Entity\ProductColor',
            'translation_domain' => 'admin_messages'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'adminbundle_product_color';
    }
}
    