<?php

namespace UNTDF\ReservasAulasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    public function newAction()
    {
        $edificio = new Edificio();

        if (!$edificio) {
            throw $this->createNotFoundException('(new) No hay edificios con ese codigo : '.$id);
        }else{
            $form = $this->createFormBuilder($edificio)
                ->add('nombre', 'text')
                ->add('grabar', 'submit')
                ->getForm();
        }

        return $this->render('UNTDFReservasAulasBundle:Edificio:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
}
