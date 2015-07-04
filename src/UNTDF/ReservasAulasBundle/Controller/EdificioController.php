<?php

namespace UNTDF\ReservasAulasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNTDF\ReservasAulasBundle\Entity\Edificio;
use UNTDF\ReservasAulasBundle\Form\EdificioType;

/**
 * Edificio controller.
 *
 */
class EdificioController extends Controller
{

    /**
     * Lists all Edificio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNTDFReservasAulasBundle:Edificio')->findAll();

        return $this->render('UNTDFReservasAulasBundle:Edificio:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Edificio entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Edificio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('edificio'));
            //return $this->redirect($this->generateUrl('edificio_show', array('id' => $entity->getId())));
        }

        return $this->render('UNTDFReservasAulasBundle:Edificio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Edificio entity.
     *
     * @param Edificio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Edificio $entity)
    {
        $form = $this->createForm(new EdificioType(), $entity, array(
            'action' => $this->generateUrl('edificio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Edificio entity.
     *
     */
    public function newAction()
    {
        $entity = new Edificio();
        $form   = $this->createCreateForm($entity);

        return $this->render('UNTDFReservasAulasBundle:Edificio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Edificio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Edificio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Edificio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNTDFReservasAulasBundle:Edificio:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Edificio entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Edificio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Edificio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNTDFReservasAulasBundle:Edificio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Edificio entity.
    *
    * @param Edificio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Edificio $entity)
    {
        $form = $this->createForm(new EdificioType(), $entity, array(
            'action' => $this->generateUrl('edificio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Edificio entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Edificio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Edificio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('edificio_edit', array('id' => $id)));
        }

        return $this->render('UNTDFReservasAulasBundle:Edificio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Edificio entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNTDFReservasAulasBundle:Edificio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Edificio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('edificio'));
    }

    /**
     * Creates a form to delete a Edificio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('edificio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
