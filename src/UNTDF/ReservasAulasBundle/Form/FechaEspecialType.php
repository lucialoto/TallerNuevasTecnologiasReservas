<?php

namespace UNTDF\ReservasAulasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FechaEspecialType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', 'datetime', array(
                    'label' => 'Fecha',
                    'widget' => 'single_text',
                    'format' => 'yyyy-mm-dd',
                    'attr' => array(
                        'class' => 'fechareservada_input_text')
                        ))
            ->add('descripcion')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNTDF\ReservasAulasBundle\Entity\FechaEspecial'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'untdf_reservasaulasbundle_fechaespecial';
    }
}
