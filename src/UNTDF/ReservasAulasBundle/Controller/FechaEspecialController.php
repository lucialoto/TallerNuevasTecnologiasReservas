<?php

namespace UNTDF\ReservasAulasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use UNTDF\ReservasAulasBundle\Entity\FechaEspecial;
use UNTDF\ReservasAulasBundle\Form\FechaEspecialType;

/**
 * FechaEspecial controller.
 *
 */
class FechaEspecialController extends Controller
{

    public function verificarfechaespecialAction(Request $request)
    {
        $fecha = $request->query->get('fecha'); 
        
        $consultaDQLselect = 'SELECT FE FROM UNTDFReservasAulasBundle:FechaEspecial FE ';
        $consultaDQLwhere = "WHERE FE.fecha = '" . $fecha ."'";
        $consultaDQLorder = ' ORDER BY FE.fecha';
        $consultaDQL = $consultaDQLselect . $consultaDQLwhere . $consultaDQLorder;
        
        // error_log($consultaDQL);
        
        $em = $this->getDoctrine()->getManager();
        $entities = $em->createQuery($consultaDQL)->getResult();
        
        // error_log(implode(" ",$entities));
        
        $retorno = array();  
        if(count($entities)){
            foreach ($entities as $entity){
                array_push($retorno, 
                        array(
                            'id' => $entity->getId(), 
                            'fecha' => date_format($entity->getFecha(), 'Y-m-d'),
                            'descripcion' => $entity->getDescripcion()
                        )
                    );
            }
        }else{
            array_push($retorno, 
                    array(
                        'id' => '', 
                        'fecha' => '',
                        'descripcion' => ''
                    )
                );
        }

        // error_log(json_encode($retorno));
        
        $response = new Response();

        $response->setContent(json_encode($retorno));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        // prints the HTTP headers followed by the content
        //$response->send();

        return $response;
    }
    
    
    /**
     * Lists all FechaEspecial entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNTDFReservasAulasBundle:FechaEspecial')->findAll();

        return $this->render('UNTDFReservasAulasBundle:FechaEspecial:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new FechaEspecial entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new FechaEspecial();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->addFlash(
                'notice',
                'Fecha creada con éxito!'
            );
            

            //return $this->redirect($this->generateUrl('fechaespecial', array('id' => $entity->getId())));
            return $this->redirect($this->generateUrl('fechaespecial'));
        }

        return $this->render('UNTDFReservasAulasBundle:FechaEspecial:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a FechaEspecial entity.
     *
     * @param FechaEspecial $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(FechaEspecial $entity)
    {
        $form = $this->createForm(new FechaEspecialType(), $entity, array(
            'action' => $this->generateUrl('fechaespecial_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new FechaEspecial entity.
     *
     */
    public function newAction()
    {
        $entity = new FechaEspecial();
        $form   = $this->createCreateForm($entity);

        return $this->render('UNTDFReservasAulasBundle:FechaEspecial:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FechaEspecial entity.
     *
     */
    /*
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:FechaEspecial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FechaEspecial entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNTDFReservasAulasBundle:FechaEspecial:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }
       
     */
    
    /**
     * Displays a form to edit an existing FechaEspecial entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:FechaEspecial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FechaEspecial entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNTDFReservasAulasBundle:FechaEspecial:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a FechaEspecial entity.
    *
    * @param FechaEspecial $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FechaEspecial $entity)
    {
        $form = $this->createForm(new FechaEspecialType(), $entity, array(
            'action' => $this->generateUrl('fechaespecial_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing FechaEspecial entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:FechaEspecial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FechaEspecial entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->addFlash(
                'notice',
                'Fecha modificada con éxito!'
            );
            
            return $this->redirect($this->generateUrl('fechaespecial'));

            
        }

        return $this->render('UNTDFReservasAulasBundle:FechaEspecial:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a FechaEspecial entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNTDFReservasAulasBundle:FechaEspecial')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FechaEspecial entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->addFlash(
                'notice',
                'Fecha eliminada con éxito!'
            );
        }

        return $this->redirect($this->generateUrl('fechaespecial'));
    }

    /**
     * Creates a form to delete a FechaEspecial entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fechaespecial_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
}
