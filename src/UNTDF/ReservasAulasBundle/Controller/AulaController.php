<?php

namespace UNTDF\ReservasAulasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNTDF\ReservasAulasBundle\Entity\Aula;
use UNTDF\ReservasAulasBundle\Form\AulaType;

/**
 * Aula controller.
 *
 */
class AulaController extends Controller
{

    /**
     * Lists all Aula entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNTDFReservasAulasBundle:Aula')->findAll();

        return $this->render('UNTDFReservasAulasBundle:Aula:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Aula entity.
     *
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
            $this->addFlash(
                'notice',
                'Aula creada con éxito!'
            );
            return $this->redirect($this->generateUrl('aulas'));
            //return $this->redirect($this->generateUrl('aulas_show', array('id' => $entity->getId())));
        }

        return $this->render('UNTDFReservasAulasBundle:Aula:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
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
            'action' => $this->generateUrl('aulas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Aula entity.
     *
     */
    public function newAction()
    {
        $entity = new Aula();
        $form   = $this->createCreateForm($entity);

        return $this->render('UNTDFReservasAulasBundle:Aula:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Aula entity.
     *
     */
    /*
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Aula')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aula entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNTDFReservasAulasBundle:Aula:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /
    /**
     * Displays a form to edit an existing Aula entity.
     *
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

        return $this->render('UNTDFReservasAulasBundle:Aula:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
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
            'action' => $this->generateUrl('aulas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array(
                    'class' => 'btn btn-primary')
                ));

        return $form;
    }
    /**
     * Edits an existing Aula entity.
     *
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
            $this->addFlash(
                'notice',
                'Aula modificada con éxito!'
            );
            return $this->redirect($this->generateUrl('aulas'));
        }

        return $this->render('UNTDFReservasAulasBundle:Aula:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Aula entity.
     *
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
            $this->addFlash(
                'notice',
                'Aula borrada con éxito!'
            );
        }

        return $this->redirect($this->generateUrl('aulas'));
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
            ->setAction($this->generateUrl('aulas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
}
