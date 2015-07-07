<?php

namespace UNTDF\ReservasAulasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CursoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder        
            ->add('nombre')
            ->add('anio')
            ->add('cantHoras')
            ->add('carreras', 'entity', array(
                    'class' => 'UNTDFReservasAulasBundle:Carrera',
                    'required' => true,
                    'multiple' => true
                        )
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UNTDF\ReservasAulasBundle\Entity\Curso'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'untdf_reservasaulasbundle_curso';
    }
}
