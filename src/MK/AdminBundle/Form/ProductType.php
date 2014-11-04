<?php

namespace MK\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use MK\Bundle\AdminBundle\Utilities\Utilities;
use MK\Bundle\AdminBundle\Form\EventListener\ProductTypeEvent;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array(
                'label' => 'product.form.title',
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('excerpt', null, array(
                'label' => 'product.form.excerpt',
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('content', null, array(
                'label' => 'product.form.content',
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('price', null, array(
                'label' => 'product.form.price',
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('discount', null, array(
                'label' => 'product.form.discount',
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('oldPrice', null, array(
                'label' => 'product.form.oldPrice',
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('productColor', null, array(
                'label' => 'product.form.productColor',
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('file', 'file', array(
                'label' => 'product.form.image',
                'attr' => array(
                    'class' => '',
                )
            ));
           
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MK\AdminBundle\Entity\Product',
            'translation_domain' => 'admin_messages'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'adminbundle_product';
    }
}
