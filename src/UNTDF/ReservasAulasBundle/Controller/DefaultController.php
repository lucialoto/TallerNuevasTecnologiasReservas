<?php

namespace UNTDF\ReservasAulasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UNTDFReservasAulasBundle:Default:index.html.twig', array('name' => $name));
    }
}
