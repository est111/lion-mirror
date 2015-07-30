<?php

namespace Biocare\StorageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StorageType extends AbstractType
{

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Biocare\StorageBundle\Entity\Storage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'biocare_storagebundle_storage';
    }
}
