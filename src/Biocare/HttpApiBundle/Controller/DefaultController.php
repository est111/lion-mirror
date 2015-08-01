<?php

namespace Biocare\HttpApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Route("/api/{test}", name="api_test")
     * @Route("/api/", name="api")
     * @Template()
     */
    public function indexAction($test = NULL) {

        $a = new \Biocare\HttpApiBundle\Entity\RuB2CPL('test');
        $a->getQuery('&func=tarif&zip=125032&weight=1001&x=121&y=1&z=1&type=post_add&price=10000');
        $response = $a->getResponse();
        return array('name' => $response);
    }

}
