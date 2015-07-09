<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Doctrine\Common\Persistence\ObjectManager;

use UNTDF\ReservasAulasBundle\Entity\Actividad;

class LoadActividad extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $actividad = array( 
            array( 
                'nombre' => 'Seguridad e higiene',
                'tipoActividad' => 'Seminario'
            ),
            array( 
                'nombre' => 'Programacion',
                'tipoActividad' => 'Seminario'
            ),    
            array( 
                'nombre' => 'Conservacion y restauracion',
                'tipoActividad' => 'Congreso'
            ),  
            array( 
                'nombre' => 'Direccion coral',
                'tipoActividad' => 'Taller'
            ),            
        );
        
        foreach( $actividad as $actividadValue ){
                        
            $actividad = new Actividad();
            $actividad->setNombre($actividadValue['nombre']);   
            $actividad->setTipoActividad($this->getReference($actividadValue['tipoActividad']));                 
            
            $this->addReference( 'evento-' . $actividadValue['nombre'], $actividad);
            
            $manager->persist($actividad);
        }
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}