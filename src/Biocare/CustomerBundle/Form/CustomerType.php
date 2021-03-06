<?php

namespace Biocare\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomerType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add('callregister', 'entity', array(
//                    'class' => 'BiocareCallBundle:CallRegister'
//                ))
                ->add('firstname')
                ->add('fathername')
                ->add('lastname')
                ->add('phonenumber')
                ->add('email','email')
//                ->add('address')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Biocare\CustomerBundle\Entity\Customer'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'biocare_customerbundle_customer';
    }

}
