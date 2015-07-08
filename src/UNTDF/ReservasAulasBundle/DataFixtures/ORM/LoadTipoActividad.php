<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Doctrine\Common\Persistence\ObjectManager;

use UNTDF\ReservasAulasBundle\Entity\TipoActividad;

class LoadTipoActividad extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $tipoActividad = array( 
            array( 
                'nombre' => 'Seminario',
                'cantidadHoras' => 8
            ),
            array( 
                'nombre' => 'Congreso',
                'cantidadHoras' => 10
            ), 
            array( 
                'nombre' => 'Taller',
                'cantidadHoras' => 10
            ),            
        );
        
        foreach( $tipoActividad as $tipoActividadValue ){
                        
            $tipoActividad = new TipoActividad();
            $tipoActividad->setNombre($tipoActividadValue['nombre']);   
            $tipoActividad->setCantidadHoras($tipoActividadValue['cantidadHoras']);
            $this->addReference($tipoActividadValue['nombre'], $tipoActividad);
            $manager->persist($tipoActividad);
        }
        
        $manager->flush();               
        
    }

    public function getOrder()
    {
        return 1;
    }
}