<?php

namespace UNTDF\ReservasAulasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use UNTDF\ReservasAulasBundle\Entity\Edificio;

class EdificioController extends Controller
{
    public function indexAction()
    {
	$edificios = $this->getDoctrine()->getRepository('UNTDFReservasAulasBundle:Edificio')->findAll();
        return $this->render('UNTDFReservasAulasBundle:Edificio:index.html.twig', array('edificios' => $edificios ));
    }
    
    public function showAction($id)
    {
        $edificio  = $this->getDoctrine()->getRepository('UNTDFReservasAulasBundle:Edificio')->find($id);

        if (!$edificio) {
            throw $this->createNotFoundException('(show) No hay edificios con ese codigo : '.$id);
        }
        
        return $this->render('UNTDFReservasAulasBundle:Edificio:show.html.twig', array('edificio' => $edificio ));
    }

    public function removeAction($id)
    {

        $edificio  = $this->getDoctrine()->getRepository('UNTDFReservasAulasBundle:Edificio')->find($id);

        if (!$edificio) {
            throw $this->createNotFoundException('(remove) No hay edificios con ese codigo : '.$id);
        }else{
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($edificio);
            $em->flush();
        }
        
        return $this->redirect($this->generateUrl('edificios'));
        
        //return $this->render('UNTDFReservasAulasBundle:Edificio:show.html.twig', array('edificio' => $edificio ));

    }

    public function createAction(Request $request){
        
        $edificio = new Edificio();

        $form = $this->createFormBuilder($edificio)
                ->add('nombre', 'text')
                ->add('grabar', 'submit', ['label' => 'Crear Edificio (crear)', 'attr' => ['class' => 'btn btn-success']])
                ->setAction($this->generateUrl('edificio/crear'))
                ->setMethod('POST')
                ->getForm();

        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($edificio);
            $em->flush();
            
            return $this->redirect($this->generateUrl('edificio/ver',array('id' => $edificio->getId())));
        }
        
        return $this->render('UNTDFReservasAulasBundle:Edificio:new.html.twig', array(
            'form' => $form->createView(),
        ));
        
    }
    
    public function newAction()
    {
        
        $edificio = new Edificio();

        $form = $this->createFormBuilder($edificio)
                ->add('nombre', 'text')
                ->add('grabar', 'submit', ['label' => 'Crear Edificio (crear)', 'attr' => ['class' => 'btn btn-success']])
                ->setAction($this->generateUrl('edificio/crear'))
                ->setMethod('POST')
                ->getForm();
        
        return $this->render('UNTDFReservasAulasBundle:Edificio:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id)
    {
        
        $edificio  = $this->getDoctrine()->getRepository('UNTDFReservasAulasBundle:Edificio')->find($id);

        if (!$edificio) {
            throw $this->createNotFoundException('(edit) No se pudo acceder a la entidad Edificio con el id '.$id);
        }else{
            $form = $this->createFormBuilder($edificio)
                    ->add('nombre', 'text')
                    ->add('grabar', 'submit')
                    ->setAction($this->generateUrl('edificio/update', array('id' => $edificio->getId())))
                    ->setMethod('POST')
                    ->getForm();
        }
        
        return $this->render('UNTDFReservasAulasBundle:Edificio:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function updateAction(Request $request, $id){
        
        $edificio  = $this->getDoctrine()->getRepository('UNTDFReservasAulasBundle:Edificio')->find($id);

        if (!$edificio) {
            throw $this->createNotFoundException('(update) No se pudo acceder a la entidad Edificio con el id '.$id);
        }else{
            $form = $this->createFormBuilder($edificio)
                    ->add('nombre', 'text')
                    ->add('grabar', 'submit')
                    ->setAction($this->generateUrl('edificio/update', array('id' => $edificio->getId())))
                    ->setMethod('POST')
                    ->getForm();
        }

        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($edificio);
            $em->flush();
            
            return $this->redirect($this->generateUrl('edificio/ver',array('id' => $edificio->getId())));
        }
        
        return $this->render('UNTDFReservasAulasBundle:Edificio:edit.html.twig', array(
            'form' => $form->createView(),
        ));
        
    }

    
}
