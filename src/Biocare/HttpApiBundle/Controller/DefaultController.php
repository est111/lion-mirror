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

        $a = new \Biocare\HttpApiBundle\Entity\HttpApi('http://is.b2cpl.ru/portal/client_api.ashx','test','test');
        
        //$a = new \Biocare\HttpApiBundle\Entity\Curl();
        $a->setUrl('http://is.b2cpl.ru/portal/client_api.ashx?client=test&key=test');
        
        $a->getQuery('&func=tarif&zip=125032&weight=1001&x=121&y=1&z=1&type=post_add&price=10000');
        $response = $a->getResponseHTML();
        return array('name' => $response);
    }

}
