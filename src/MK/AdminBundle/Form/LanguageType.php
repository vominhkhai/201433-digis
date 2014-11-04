<?php

namespace MK\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use MK\Bundle\AdminBundle\Utilities\Utilities;
use MK\Bundle\AdminBundle\Form\EventListener\ProductTypeEvent;

class LanguageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'language.form.name',
                'attr' => array(
                    'class' => 'form-control',
                )
            ))
            ->add('langKey', null, array(
                'label' => 'language.form.langKey',
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
            'data_class' => 'MK\AdminBundle\Entity\Language',
            'translation_domain' => 'admin_messages'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'adminbundle_language';
    }
}
    