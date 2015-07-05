<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Doctrine\Common\Persistence\ObjectManager;

use UNTDF\ReservasAulasBundle\Entity\Aula;

class LoadAulas extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $aulas = array( 
            array( 
                'nombre' => 'Aula H',
                'edificio' => 'HY'
            ),
            array( 
                'nombre' => 'Aula 10',
                'edificio' => 'DC'
            ),            
        );
        
        foreach( $aulas as $aulaValue ){
                        
            $aula = new Aula();
            $aula->setEdificio($this->getReference('edificio-' . $aulaValue['edificio']) );
            $aula->setNombre($aulaValue['nombre']);                    
            
            $manager->persist($aula);
        }
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 2;
    }    
}