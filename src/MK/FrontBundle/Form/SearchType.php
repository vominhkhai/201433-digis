<?php

namespace MK\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SearchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('keyword', 'text', array(
                'label' => 'search.form.keyword',
                'attr' => array(
                    'class' => 'form-control',
                ),
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
    