<?php

namespace Biocare\PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Biocare\CallBundle\Entity\CallRegister;
use Biocare\OrderBundle\Entity\Orders;
use Biocare\StorageBundle\Entity\Cart;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/router/{info}", name="call")
     * @Template()
     */
    public function indexAction(Request $request, $info = NULL) {


        $session = $this->get('session');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $ip = $this->get('request')->getClientIp();

        if (!$info) {
            $info = preg_replace('/\s+/', '', $request->get('info'));
        }
        // ZOPIER PL

        $info = explode('-', $info);
        
            $source = @$info[0] ? $info[0] : null;
            $destination = @$info[1] ? $info[1] : null;
        
        $callregister = new CallRegister();
        $callregister->setCreatedBy($user);
        $callregister->setCreatedFromIp($ip);
        $callregister->setSource($source);
        $callregister->setDestination($destination);

        
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($callregister);
        
        
        $order = new Orders();
        $order->setCallregister($callregister);
        
            $cart = new Cart();
            $cart->setName('New Cart');
            $em->persist($cart);
        
        $order->setCart($cart);        
        
        $em->persist($order);
        
        $em->flush();


        $session->set('callregister', $callregister);


        return $this->redirectToRoute('panel');
    }

}
