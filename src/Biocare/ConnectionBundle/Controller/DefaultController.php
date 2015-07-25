<?php

namespace Biocare\ConnectionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Biocare\ConnectionBundle\Entity\Connexion;
use Biocare\ConnectionBundle\Form\ConnexionType;

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

        $source =       preg_replace('/\s+/', '', $request->get('source'));
        $destination =  preg_replace('/\s+/', '', $request->get('destination'));

        $defaultData = array(
            'source' => $source,
            'destination' => $destination
        );
        $options = array(
            'action' => $this->generateUrl('connexion_form'),
            'method' => 'POST',
        );
        $form = $this->get('form.factory')->createNamedBuilder("check_connexion",'form',$defaultData,$options);
        
        $connexion = 0;
        
        if ($destination) {
                $connexion++;
        } else {
                $form->add('destination', 'text');
        }
        
        if ($source) {
                $connexion++;
        } else {     
                $form->add('source', 'text');
        }
        
        if ($connexion==2){
            return $this->redirect($this->generateUrl('connexion_new', $defaultData));
        }
        
        $form->add('submit', 'submit', array('label' => 'Potwierdź dane klienta'));
        $form = $form->getForm();
        if ($request->isMethod('POST')) {
            $form->bind($request);

            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            return $this->redirect($this->generateUrl('connexion_new', array('source'=>$data['source'],'destination'=>$data['destination']) ));
        }
        return array(
            'form' => $form->createView(),
        );
    }

    
    /**
     * Displays a form to create a new Connexion entity.
     *
     * @Route("/connexion/{source}/{destination}/", name="connexion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($source, $destination)
    {
        $entity = new Connexion($source, $destination);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    
    
}
