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

    public function indexAction(Request $request){
        
        $em = $this->getDoctrine()->getManager();

        $eventos = $em->getRepository('UNTDFReservasAulasBundle:Evento')->findAll();
        $aulas = $em->getRepository('UNTDFReservasAulasBundle:Aula')->findAll();
        $docentes = $em->getRepository('UNTDFReservasAulasBundle:Docente')->findAll();        

        return $this->render('UNTDFReservasAulasBundle:ReservasMain:index.html.twig', array(
            'eventos'  => $eventos,
            'aulas'    => $aulas,
            'docentes' => $docentes,
        ));


    }
}
