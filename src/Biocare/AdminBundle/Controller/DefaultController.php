<?php

namespace Biocare\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     * @Template()
     */
    public function indexAction($name = "Admin Panel")
    {
        return array('name' => $name);
    }
}
