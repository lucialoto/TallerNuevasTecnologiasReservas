<?php

namespace UNTDF\ReservasAulasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReservaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('fecha', 'datetime', array(
                    'label' => 'Fecha Reservada',
                    'widget' => 'single_text',
                    'format' => 'Y-M-d',
                    'attr' => array(
                        'class' => 'fechareservada_input_text')
                        )
                )
                ->add('horadesde','time', array('label' => 'Hora desde'))
                ->add('horahasta','time', array('label' => 'Hora hasta'))
                ->add('estado', 'choice', array(
                    'choices' => array(
                        'solicitado' => 'solicitado', 
                        'rechazado' => 'rechazado',
                        'reservado' => 'reservado'),
                    'required' => true,
                    'preferred_choices' => array('solicitado')
                    )
                )
                ->add('observacion')
                ->add('aula', 'entity', array('class' => 'UNTDFReservasAulasBundle:Aula'))
                ->add('docente', 'entity', array('class' => 'UNTDFReservasAulasBundle:Docente'))
                ->add('recursos', 'entity', array(
                    'class' => 'UNTDFReservasAulasBundle:Recurso',
                    'required' => false,
                    'multiple' => true
                        )
                )
                ->add('reservafecha', 'datetime', array(
                    'widget' => 'single_text',
                    'format' => 'Y-M-d',
                    'data' =>  new \DateTime('now'),
                    'read_only' => true
                    )
                )
                ->add('reservausuario', 'entity', array(
                    'class' => 'UNTDFReservasAulasBundle:User',
                    'disabled' => true
                        //,
                        //'data' => $this->getDoctrine()->getManager()->getReference('UNTDFReservasAulasBundle:User', $this->getUser()->getId())
                        )
                )
                ->add('evento', 'entity', array('class' => 'UNTDFReservasAulasBundle:Evento'))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'UNTDF\ReservasAulasBundle\Entity\Reserva'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'untdf_reservasaulasbundle_reserva';
    }

}
