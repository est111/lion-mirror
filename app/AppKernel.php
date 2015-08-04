<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Biocare\ConnectionBundle\BiocareConnectionBundle(),
            new Yellowknife\BowerBundle\YellowknifeBowerBundle(),
            new Biocare\CarrierBundle\BiocareCarrierBundle(),
            new Biocare\PanelBundle\BiocarePanelBundle(),
            new Biocare\CallBundle\BiocareCallBundle(),
            new Biocare\CustomerBundle\BiocareCustomerBundle(),
            new Biocare\AddressBundle\BiocareAddressBundle(),
            new Biocare\OrderBundle\BiocareOrderBundle(),
            new Biocare\ProductBundle\BiocareProductBundle(),
            new Biocare\StorageBundle\BiocareStorageBundle(),
            new Biocare\HttpApiBundle\BiocareHttpApiBundle(),
            new Biocare\PriceBundle\BiocarePriceBundle(),
            new Biocare\CampaignBundle\BiocareCampaignBundle(),
            new Biocare\AdminBundle\BiocareAdminBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
