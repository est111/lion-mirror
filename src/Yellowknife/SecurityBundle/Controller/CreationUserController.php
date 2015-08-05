<?php

namespace Yellowknife\SecurityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * User controller.
 *
 * @Route("/admin/user")
 */
class CreationUserController extends Controller {

    /**
     *
     * @Route("/userCreation", name="admin_user_creation")
     * @Method({"GET","POST"})
     * @Template()
     */
    public function userCreationAction(Request $request) {
        $data = array();
        $form = $this->createFormBuilder($data)
                ->add('query', 'text')
                ->add('category', 'choice', array('choices' => array(
                        'judges' => 'Judges',
                        'interpreters' => 'Interpreters',
                        'attorneys' => 'Attorneys',
            )))
                ->getForm();

        if ($request->isMethod('POST')) {
            $form->bind($request);
            $data = $form->getData();
        }


        return array('form' => $form);
    }

}
