<?php

namespace Yellowknife\SecurityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Yellowknife\SecurityBundle\Entity\User;


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

            $user = new User();
            // check if user exist by email
            $user->setLocale($data["locale"]);
            $user->setEmail($data["email"]);
            $email_check = $this->getDoctrine()
                    ->getRepository('YellowknifeSecurityBundle:User')
                    ->findBy(array(
                'email' => $user->getEmail()
            ));

            if ($email_check) {

                $this->get('session')->getFlashBag()->add(
                        'warning', 'EMAIL IS ALREADY IN DATABASE FIND IT AND RESET A PASSWORD: ' . $user->getEmail()
                );
                return $this->redirect($this->generateUrl('admin_user'));
            }
            $user->setFirstname($data["name"]);
            $user->setLastname($data["surname"]);

            $user_check = $this->getDoctrine()
                    ->getRepository('YellowknifeSecurityBundle:User')
                    ->findBy(array(
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname()
            ));

            $username = strtolower($user->getFirstname() . "." . $user->getLastname() . (count($user_check) > 0 ? count($user_check) : ''));

            $user->setUsername($username);

            $generator = new SecureRandom();
            $password = bin2hex($generator->nextBytes(4));

            $message = \Swift_Message::newInstance()
                    ->setSubject('Password Lion CRM')
                    ->setFrom('karol.gontarski@gmail.com')
                    ->setTo($user->getEmail())
                    ->setBody('User: ' . $username . '  Password: ' . $password, 'text/plain'
            );


            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $password);

            $user->setPassword($encoded);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->container->get('mailer')->send($message);
            
            return $this->redirect($this->generateUrl('admin_user'));
      
        }
    }
    
    /**
     * Reset user password
     * 
     * @Route("/resetPassword/{id}", name="admin_user_creation_resetpassword")
     * @Method("GET")
     */
    public function resetPasswordAction($id) {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('YellowknifeSecurityBundle:User')->findOneBy(array(
            'id' => $id
        ));


        $generator = new SecureRandom();
        $password = bin2hex($generator->nextBytes(4));

        $message = \Swift_Message::newInstance()
                ->setSubject('Password Lion CRM')
                ->setFrom('karol.gontarski@gmail.com')
                ->setTo($entity->getEmail())
                ->setBody('User: ' . $entity->getUsername() . '  Password: ' . $password, 'text/plain'
        );


        $this->container->get('mailer')->send($message);
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($entity, $password);

        $entity->setPassword($encoded);

        $this->get('session')->getFlashBag()->add(
                'notice', 'Password sent to: ' . $entity->getEmail()
        );
        $em->flush();
        return $this->redirect($this->generateUrl('admin_user'));
    }
    
    

}
