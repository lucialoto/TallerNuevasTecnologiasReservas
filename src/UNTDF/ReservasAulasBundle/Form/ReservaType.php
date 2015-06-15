<?php

namespace UNTDF\ReservasAulasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReservaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha')
            ->add('horadesde')
            ->add('horahasta')
            ->add('estado')
            ->add('observacion')
            ->add('reservafecha')
            ->add('aula','entity',array('class' => 'UNTDFReservasAulasBundle:Aula'))
            ->add('docente','entity',array('class' => 'UNTDFReservasAulasBundle:Docente'))
            ->add('recursos','entity', array(
                    'class' => 'UNTDFReservasAulasBundle:Recurso',
                    'multiple' => true
                  )
            )
            ->add('reservausuario')
            ->add('evento','entity',array('class' => 'UNTDFReservasAulasBundle:Evento'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNTDF\ReservasAulasBundle\Entity\Reserva'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'untdf_reservasaulasbundle_reserva';
    }
}
