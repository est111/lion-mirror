<?php

namespace Biocare\CallBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SourceType extends AbstractType
{

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Biocare\CallBundle\Entity\Source'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'biocare_callbundle_source';
    }
}
