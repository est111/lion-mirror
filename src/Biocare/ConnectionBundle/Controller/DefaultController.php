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
     * @Route("/")
     * @Method({"GET","POST"})
     * 
     * @Template() 
     */
    public function indexAction(Request $request) {

        $source = preg_replace('/\s+/', '', $request->get('source'));
        $destination = preg_replace('/\s+/', '', $request->get('destination'));




        $defaultData = array();
        $form = $this->createFormBuilder($defaultData);
                
                
                
        
        
        switch ($source) {
            case null:
                
                $form->add('source', 'text');                
                break;
            default:
                throw new \Exception('Hello ' . $source);
                break;
        }

        switch ($destination) {
            case null:
                $form->add('destination', 'text');
                break;
            default:
                throw new \Exception('I know where to go ...');
                break;
        }

        $form->getForm();

       

        if ($request->isMethod('POST')) {
            $form->bind($request);

            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
        }

        return array(
            'form' => $form->createView()
        );
    }

}
