<?php

namespace Yellowknife\SecurityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Util\SecureRandom;

/**
 * User controller.
 *
 * @Route("/admin")
 */
class UserCreationController extends Controller {

    public function createUserCreationForm() {
        $data = array(
        );
        $option = array(
            'action' => $this->generateUrl('admin_user_creation_new'),
        );
        $form = $this->createFormBuilder($data, $option)
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
                    ),
                    'label' => false
                ))
                ->getForm();

        return $form;
    }

    /**
     *
     * @Route("/userCreation", name="admin_user_creation")
     * @Method("GET")
     * @Template()
     */
    public function userCreationAction(Request $request) {

        $form = $this->createUserCreationForm();


        return array('form' => $form->createView());
    }

    /**
     *
     * @Route("/userCreation", name="admin_user_creation_new")
     * @Method("POST")
     * @Template()
     */
    public function newUserCreationAction(Request $request) {
        $form = $this->createUserCreationForm();
        if ($request->isMethod('POST')) {
            $form->bind($request);
            $data = $form->getData();
            return $this->redirect($this->generateUrl('admin_user'));
        }
    }

}
