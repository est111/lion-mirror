<?php

namespace Biocare\PriceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CurrencyType extends AbstractType
{

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Biocare\PriceBundle\Entity\Currency'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'biocare_pricebundle_currency';
    }
}
