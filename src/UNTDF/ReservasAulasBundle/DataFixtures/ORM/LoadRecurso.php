<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use UNTDF\ReservasAulasBundle\Entity\Recurso;

class LoadRecurso extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {        
        $recursos = array( 
            'Proyector/Cañon', 
            'Equipo de Teleconferencia', 
            'Pizzara, Marcadores, Borradores', 
            'Acceso a Internet'
        );
        
        foreach( $recursos as $recursoValue ){
            
            $recurso = new Recurso();
            $recurso->setNombre( $recursoValue );

            $this->addReference( 'recurso-' . $recursoValue, $recurso);

            $manager->persist($recurso);
        }
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 1;
    }
}
