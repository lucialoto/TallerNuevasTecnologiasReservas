<?php

namespace UNTDF\ReservasAulasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use UNTDF\ReservasAulasBundle\Entity\Reserva;
use UNTDF\ReservasAulasBundle\Form\ReservaType;

/**
 * Reserva controller.
 *
 */
class ReservaController extends Controller
{

     /**
     * Listado filtrado de elementos.
     * para utilizar con ajax.
     * 
     */
    public function listadoAction(Request $request)
    {
        $fechadesde = $request->query->get('fechadesde'); 
        $fechahasta = $request->query->get('fechahasta');
        $evento = $request->query->get('evento');
        $aula = $request->query->get('aula');
        $docente = $request->query->get('docente'); 
                
        $consultaDQLselect = 'SELECT R FROM UNTDFReservasAulasBundle:Reserva R ';
        $consultaDQLwhere = "WHERE R.fecha >= '" . $fechadesde . "' AND R.fecha <= '" . $fechahasta ."'";
        if ($evento != 0) {
            $consultaDQLwhere = $consultaDQLwhere . " AND R.evento = " . $evento;
        }        
        if ($aula != 0) {
            $consultaDQLwhere = $consultaDQLwhere . " AND R.aula = " . $aula;
        }        
        if ($docente != 0) {
            $consultaDQLwhere = $consultaDQLwhere . " AND R.docente = " . $docente;
        }        
        $consultaDQLorder = ' ORDER BY R.fecha DESC, R.horadesde DESC, R.horahasta DESC';
        $consultaDQL = $consultaDQLselect . $consultaDQLwhere . $consultaDQLorder;
        
        error_log($consultaDQL);
        
        $em = $this->getDoctrine()->getManager();
        $entities = $em->createQuery($consultaDQL)->getResult();
        
        $retorno = array();        
        foreach ($entities as $entity){
            array_push($retorno, 
                    array(
                        //'query' => $qb->getDql(),
                        'id' => $entity->getId(), 
                        'fecha' => date_format($entity->getFecha(), 'Y-m-d'),
                        'horadesde' => date_format($entity->getHoradesde(), 'H:i:s'), 
                        'horahasta' => date_format($entity->getHorahasta(), 'H:i:s'),
                        'evento' => $entity->getEvento()->getNombre(),
                        'aula' => $entity->getAula()->getNombre(),
                        'estado' => $entity->getEstado(),
                        'observacion' => $entity->getObservacion(),
                        'recursos' => $entity->obtenerListaRecursos(),
                        'reservado' => date_format($entity->getReservafecha(), 'Y-m-d'),
                        'docente' => $entity->getDocente()->getNombre()
                        )
                    );
            
        }
        
        $response = new Response();

        $response->setContent(json_encode($retorno));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        // prints the HTTP headers followed by the content
        //$response->send();

        return $response;
    }
    
    /*
     * Lists all Reserva entities.
     *
     */
    public function index2Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        
        $entities = $em->createQuery(
                'SELECT R FROM UNTDFReservasAulasBundle:Reserva R '
                . 'ORDER BY R.fecha DESC, R.horadesde DESC, R.horahasta DESC'
            )
            ->getResult();


        return $this->render('UNTDFReservasAulasBundle:Reserva:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    
    /**
     * Lists all Reserva entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNTDFReservasAulasBundle:Reserva')->findAll();

        return $this->render('UNTDFReservasAulasBundle:Reserva:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Creates a new Reserva entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Reserva();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('reserva_show', array('id' => $entity->getId())));
        }

        return $this->render('UNTDFReservasAulasBundle:Reserva:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Reserva entity.
     *
     * @param Reserva $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Reserva $entity)
    {
        /* para cargar valores por defecto en el formulario */
        // $entity->setReservafecha(new DateTime("NOW"));
        // $entity->setReservausuario($this->getUser()->getUsername());
        $form = $this->createForm(new ReservaType(), $entity, array(
            'action' => $this->generateUrl('reserva_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Reserva entity.
     *
     */
    public function newAction()
    {
        $entity = new Reserva();
        $form   = $this->createCreateForm($entity);

        return $this->render('UNTDFReservasAulasBundle:Reserva:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Reserva entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Reserva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reserva entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNTDFReservasAulasBundle:Reserva:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Reserva entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Reserva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reserva entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNTDFReservasAulasBundle:Reserva:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Reserva entity.
    *
    * @param Reserva $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Reserva $entity)
    {
        $form = $this->createForm(new ReservaType(), $entity, array(
            'action' => $this->generateUrl('reserva_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Reserva entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Reserva')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reserva entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('reserva_edit', array('id' => $id)));
        }

        return $this->render('UNTDFReservasAulasBundle:Reserva:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Reserva entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNTDFReservasAulasBundle:Reserva')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Reserva entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('reserva'));
    }

    /**
     * Creates a form to delete a Reserva entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reserva_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
