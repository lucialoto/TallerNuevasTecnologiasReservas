<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use UNTDF\ReservasAulasBundle\Entity\Carrera;

class LoadCarrera implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $carrera = array( 
            array( 
                'nombre' => 'Licenciatura en sistemas'
            ),
            array( 
                'nombre' => 'Licenciatura en turismo'
            ),    
            array( 
                'nombre' => 'Técnico contable'
            ),           
        );
        
        foreach( $carrera as $carreraValue ){
                        
            $carrera = new Carrera();
            $carrera->setNombre($carreraValue['nombre']);               
            
            $manager->persist($carrera);
        }
        
        $manager->flush();
    }
}