<?php

namespace Biocare\HttpApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Route("/api/", name="api")
     * @Template()
     */
    public function indexAction() {

        $response = "";
        
        $args = array(
            array('191520','1000',array('1','1','1'),'post_add','1000'),
            array('201520','1000',array('1','1','1'),'post_add','2000'),
            array('211520','1000',array('1','1','1'),'post_add','3000'),
            array('321520','1000',array('1','1','1'),'post_add','4000'),
            array('421520','1000',array('1','1','1'),'post_add','5000'),
            array('431520','1000',array('1','1','1'),'post_add','6000'),
            array('441520','1000',array('1','1','1'),'post_add','7000'),
            array('411520','1000',array('1','1','1'),'post_add','8000'),
            array('491520','1000',array('1','1','1'),'post_add','9000'),
            array('511520','1000',array('1','1','1'),'post_add','10000'),
            array('601520','1000',array('1','1','1'),'post_add','11000'),
            array('601520','1000',array('1','1','1'),'post_add','12000'),
        );
        
        
//        $a = new \Biocare\HttpApiBundle\Entity\RuB2CPL('test');    
//        $a->tarif();
//        $response .= $a->getResponseTEST();
//        
        
        
        foreach ($args as $arg) {
            $b = new \Biocare\HttpApiBundle\Entity\RuB2CPL(); 
            $b->tarif($arg[0],$arg[1],$arg[2],$arg[3],$arg[4]);
            $response .= $b->getResponseTEST();
            unset($b);
        }
        
          
        
        
        
        
        return array('name' => $response);
    }

}
