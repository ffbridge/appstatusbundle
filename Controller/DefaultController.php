<?php

namespace Kilix\AppStatusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KilixAppStatusBundle:Default:index.html.twig', array('name' => $name));
    }
}
