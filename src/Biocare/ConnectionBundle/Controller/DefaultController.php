<?php

namespace Biocare\ConnectionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    /**
     * @param Request $request
     * @return Response
     * @Route("/", name="connexion_form")
     * @Method({"GET","POST"})
     * 
     * @Template() 
     */
    public function indexAction(Request $request) {

        $source = preg_replace('/\s+/', '', $request->get('source'));
        $destination = preg_replace('/\s+/', '', $request->get('destination'));

        $defaultData = array();
        $options = array(
            'action' => $this->generateUrl('connexion_form'),
            'method' => 'POST',
        );
        $form = $this->get('form.factory')->createNamedBuilder("check_connexion",'form',$defaultData,$options);
        
        if ($destination) {
                $form->add('destination', 'text');
        } else {
                $form->add('destination', 'text');
        }
        
        if ($source) {
                $form->add('source', 'text');  
        } else {     
                $form->add('source', 'text');
        }
        
        $form->add('submit', 'submit', array('label' => 'Potwierdź dane klienta'));
        $form = $form->getForm();
        if ($request->isMethod('POST')) {
            $form->bind($request);

            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
        }
        return array(
            'form' => $form->createView(),
        );
    }

}
