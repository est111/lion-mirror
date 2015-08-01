<?php

namespace Biocare\HttpApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Route("/api/{country}/{company}/", name="api_tarif")
     * @Template()
     */
    public function tarifAction($country, $company) {

        if ($country == 'ru') {
            if ($company == 'b2cpl') {
                $api = new \Biocare\HttpApiBundle\Entity\RuB2CPL();
            }
        }       
        $api->tarif('194156','500',array('1','1','1'),'post','1000');
        $response = $api->getResponse();
        
        
        $resp = json_decode($response);
        $html = "<select class='col-lg-12 select2'>";
        foreach ($resp->delivery_ways as $dw) {
            $html .="<option value='" . $dw->Стоимость . "'>" . $dw->Наименование . " - " . $dw->Стоимость . " - " . $dw->Код . "</option>";
        }
        $html .="</select>";
        
        
        return array('name'=>$html);
    }

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
          $b = new \Biocare\HttpApiBundle\Entity\RuB2CPL('test');
          $b->tarif($arg[0],$arg[1],$arg[2],$arg[3],$arg[4]);
          $response .= $b->getResponseTEST($arg[0])."<br/>";
          unset($b);

          $a = new \Biocare\HttpApiBundle\Entity\RuB2CPL('test');
          $a->tarif($arg[0],$arg[1],$arg[2],$arg[3],$arg[4]*10);
          $response .= $a->getResponseTEST($arg[0])."<br/>";
          unset($a);

          $c = new \Biocare\HttpApiBundle\Entity\RuB2CPL('test');
          $c->tarif($arg[0],$arg[1],$arg[2],'post',$arg[4]);
          $response .= $c->getResponseTEST($arg[0])."<br/>";
          unset($c);

          $d = new \Biocare\HttpApiBundle\Entity\RuB2CPL('test');
          $d->tarif($arg[0],$arg[1],$arg[2],'post',$arg[4]*10);
          $response .= $d->getResponseTEST($arg[0])."<br/>";
          unset($d);

          $e = new \Biocare\HttpApiBundle\Entity\RuB2CPL('test');
          $e->tarif($arg[0],$arg[1],$arg[2],'+post',$arg[4]);
          $response .= $e->getResponseTEST($arg[0])."<br/>";
          unset($e);

          $f = new \Biocare\HttpApiBundle\Entity\RuB2CPL('test');
          $f->tarif($arg[0],$arg[1],$arg[2],'+post',$arg[4]*10);
          $response .= $f->getResponseTEST($arg[0])."<br/>";
          unset($f);
          }



         


        return array('name' => $response);
    }

}
