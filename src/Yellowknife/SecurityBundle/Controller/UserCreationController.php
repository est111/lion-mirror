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
 * @Route("/admin")
 */
class UserCreationController extends Controller {

    /**
     *
     * @Route("/userCreation", name="admin_user_creation")
     * @Method({"GET","POST"})
     * @Template()
     */
    public function userCreationAction(Request $request) {
        $data = array(
            array(
                'action' => $this->generateUrl('admin_user'),
            )
        );
        $form = $this->createFormBuilder($data)
                ->add('name', 'text', array('attr' => array('placeholder' => 'Name'), 'label' => false))
                ->add('surname', 'text', array('attr' => array('placeholder' => 'Surname'), 'label' => false))
                ->add('email', 'email', array('attr' => array('placeholder' => 'E-mail'), 'label' => false))
                ->add('locale', 'choice', array(
                    'choices' => array(
                        'en' => 'English',
                        'ru' => 'Russian',
                        'cz' => 'Czech',
                        'sk' => 'Slovak',
                        'hu' => 'Hungarian',
                    ),
                    'attr' => array(
                        'placeholder' => 'Locale'
                    ), 'label' => false))
                ->getForm();

        if ($request->isMethod('POST')) {
            $form->bind($request);
            $data = $form->getData();

            dump($data);
        }

        return array('form' => $form->createView());
    }


}
