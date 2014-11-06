<?php

namespace MK\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use MK\CommonBundle\Utilities\Utilities;

class FilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', 'choice', array(
                'label' => 'filter.form.price',
                'choices' => Utilities::getParameter('filter.price'),
                'attr' => array(
                    'class' => 'form-control',
                    'onchange' => 'sumbitFilterForm()'
                ),
                'empty_value' => 'filter.form.choice.all'
            ))
            ->add('category', 'entity', array(
                'label' => 'filter.form.category',
                'class' => 'MKAdminBundle:Category',
                'attr' => array(
                    'class' => 'form-control',
                    'onchange' => 'sumbitFilterForm()'
                ),
                'empty_value' => 'filter.form.choice.all'
            ))
            ->add('color', 'entity', array(
                'label' => 'filter.form.color',
                'class' => 'MKAdminBundle:ProductColor',
                'attr' => array(
                    'class' => 'form-control',
                    'onchange' => 'sumbitFilterForm()'
                ),
                'empty_value' => 'filter.form.choice.all'
            ));
    }
    
        /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
            'translation_domain' => 'admin_messages',
            'required' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}
    