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
        $data = array();
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
            
            $user = new Yellowknife\SecurityBundle\Entity\User();

            $user->setEmail($form->get("email")->getData());
            $email_check = $this->getDoctrine()
                    ->getRepository('YellowknifeUserBundle:User')
                    ->findBy(array(
                'email' => $user->getEmail()
            ));

            if ($email_check) {

                $this->get('session')->getFlashBag()->add(
                        'warning', 'EMAIL IS ALREADY IN DATABASE FIND IT AND RESET A PASSWORD: ' . $user->getEmail()
                );
                return $this->redirect($this->generateUrl('callcenter_show', array('id' => $entity->getCallcenter()->getId())));
            }

            $user->setFirstname($form->get("name")->getData());
            $user->setLastname($form->get("surname")->getData());

            $user_check = $this->getDoctrine()
                    ->getRepository('YellowknifeUserBundle:User')
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

            $entity->setUser($user);


            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);

                $em->flush();

                $this->container->get('mailer')->send($message);
                return $this->redirect($this->generateUrl('callcenter_show', array('id' => $entity->getCallcenter()->getId())));
            }

            return array(
                'entity' => $entity,
                'form' => $form->createView(),
            );
        }


        return array('form' => $form->createView());
    }

}
