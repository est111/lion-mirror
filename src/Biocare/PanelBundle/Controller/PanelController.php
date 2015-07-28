<?php

namespace Biocare\PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PanelController extends Controller {

    /**
     * @Route("/panel/", name="panel")
     * @Template()
     */
    public function indexAction() {

        $callregister = $this->get('session')->get('callregister');
        if (!$callregister) {
            return $this->redirectToRoute('call');
        }
        return array(
            'callregister' => $callregister
                );
    }

}
