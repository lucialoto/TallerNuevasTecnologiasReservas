<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Doctrine\Common\Persistence\ObjectManager;

use UNTDF\ReservasAulasBundle\Entity\Carrera;

class LoadCarrera extends AbstractFixture implements OrderedFixtureInterface
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
            $this->addReference($carreraValue['nombre'], $carrera);
            $manager->persist($carrera);
        }
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}