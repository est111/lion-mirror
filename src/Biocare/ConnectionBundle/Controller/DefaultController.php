<?php

namespace Biocare\ConnectionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template; 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     * @Route("/")
     * @Method({"GET"})
     * 
     * @Template() 
     */
    public function indexAction(Request $request)
    {
        
        $source      = preg_replace('/\s+/', '', $request->get('source'));
        $destination = preg_replace('/\s+/', '', $request->get('destination'));
        
        
        dump($source,$destination);
        
        
        switch ($source) {
            case null:
                throw new \Exception('Who\'s there?');
                break;
            default:
                throw new \Exception('Hello '.$source);
                break;
        }    
        
        switch ($destination) {
            case null:
                throw new \Exception('Where to go ...');
                break;
            default:
                throw new \Exception('I know where to go ...');
                break;
        }
        
        
        exit;
        return array('name' => $name);
    }
    
    /**
     * @param String $source Source for connexion
     * @param String $destination Destination for connexion
     * 
     * @return Response
     * 
     * @Route("/")
     * 
     * @Template() 
     */
    public function newConnexionAction(String $source, String $destination)
    {
        
        dump($source,$destination);
        
    }
    
}
