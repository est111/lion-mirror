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
            array('685000','1000',array('1','1','1'),'post_add','1000'),
            array('664047','1000',array('1','1','1'),'post_add','1000'),
            array('630078','1000',array('1','1','1'),'post_add','1000'),
            array('121500','1000',array('1','1','1'),'post_add','1000'),
            array('194156','1000',array('1','1','1'),'post_add','1000'),
            array('678400','1000',array('1','1','1'),'post_add','1000'),
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
            
            $a = new \Biocare\HttpApiBundle\Entity\RuB2CPL(); 
            $a->tarif($arg[0],$arg[1],$arg[2],'post',$arg[4]);
            $response .= $a->getResponseTEST();
            unset($a);
        }
        
          
        
        
        
        
        return array('name' => $response);
    }

}
