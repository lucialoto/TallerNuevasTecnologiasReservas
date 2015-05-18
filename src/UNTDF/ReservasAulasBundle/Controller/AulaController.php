<?php

namespace UNTDF\ReservasAulasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use UNTDF\ReservasAulasBundle\Entity\Aula;
use UNTDF\ReservasAulasBundle\Form\AulaType;

/**
 * Aula controller.
 *
 * @Route("/aula")
 */
class AulaController extends Controller
{

    /**
     * Lists all Aula entities.
     *
     * @Route("/", name="aula")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNTDFReservasAulasBundle:Aula')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Aula entity.
     *
     * @Route("/", name="aula_create")
     * @Method("POST")
     * @Template("UNTDFReservasAulasBundle:Aula:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Aula();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('aula_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Aula entity.
     *
     * @param Aula $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Aula $entity)
    {
        $form = $this->createForm(new AulaType(), $entity, array(
            'action' => $this->generateUrl('aula_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Aula entity.
     *
     * @Route("/new", name="aula_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Aula();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Aula entity.
     *
     * @Route("/{id}", name="aula_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Aula')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aula entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Aula entity.
     *
     * @Route("/{id}/edit", name="aula_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Aula')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aula entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Aula entity.
    *
    * @param Aula $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Aula $entity)
    {
        $form = $this->createForm(new AulaType(), $entity, array(
            'action' => $this->generateUrl('aula_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Aula entity.
     *
     * @Route("/{id}", name="aula_update")
     * @Method("PUT")
     * @Template("UNTDFReservasAulasBundle:Aula:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Aula')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aula entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('aula_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Aula entity.
     *
     * @Route("/{id}", name="aula_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNTDFReservasAulasBundle:Aula')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Aula entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('aula'));
    }

    /**
     * Creates a form to delete a Aula entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('aula_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
