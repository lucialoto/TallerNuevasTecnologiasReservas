<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UNTDF\ReservasAulasBundle\Controller;

# use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

# use UNTDF\ReservasAulasBundle\Entity\ReservasMain;

/**
 * Description of ReservasMain
 *
 * @author msampirisi
 */
class ReservasMainController extends Controller {

    public function indexAction(){
        $em = $this->getDoctrine()->getManager();

        return $this->render('UNTDFReservasAulasBundle:ReservasMain:index.html.twig');
    }
}
