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

    private $form;

    public function __construct() {
        $data = array(
        );
        $option = array(
            'action' => $this->generateUrl('admin_user_creation'),
        );
        $this->form = $this->createFormBuilder($data, $option)
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

        parent::__construct();
    }

    /**
     *
     * @Route("/userCreation", name="admin_user_creation")
     * @Method({"GET","POST"})
     * @Template()
     */
    public function userCreationAction(Request $request) {


        if ($request->isMethod('POST')) {
            $this->form->bind($request);
            $data = $$this->form->getData();
            return $this->redirect($this->generateUrl('admin_user'));
        }

        return array('form' => $$this->form->createView());
    }

    public function newUserCreationAction(Request $request) {
        
    }

}
