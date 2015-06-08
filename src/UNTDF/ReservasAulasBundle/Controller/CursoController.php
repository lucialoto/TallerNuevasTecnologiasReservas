<?php

namespace UNTDF\ReservasAulasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNTDF\ReservasAulasBundle\Entity\Curso;

/**
 * Curso controller.
 *
 */
class CursoController extends Controller
{

    /**
     * Lists all Curso entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNTDFReservasAulasBundle:Curso')->findAll();

        return $this->render('UNTDFReservasAulasBundle:Curso:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Curso entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Curso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Curso entity.');
        }

        return $this->render('UNTDFReservasAulasBundle:Curso:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
