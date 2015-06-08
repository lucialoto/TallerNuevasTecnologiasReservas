<?php

namespace UNTDF\ReservasAulasBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNTDF\ReservasAulasBundle\Entity\Actividad;

/**
 * Actividad controller.
 *
 */
class ActividadController extends Controller
{

    /**
     * Lists all Actividad entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNTDFReservasAulasBundle:Actividad')->findAll();

        return $this->render('UNTDFReservasAulasBundle:Actividad:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Actividad entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Actividad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Actividad entity.');
        }

        return $this->render('UNTDFReservasAulasBundle:Actividad:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
