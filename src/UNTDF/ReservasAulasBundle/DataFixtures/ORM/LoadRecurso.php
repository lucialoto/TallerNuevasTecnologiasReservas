<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use UNTDF\ReservasAulasBundle\Entity\User;

class LoadUsuarios implements FixtureInterface
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
            
            $recurso = new Edificio();
            $recurso->setNombre( $recursoValue );
            
            $manager->persist($recurso);
        }
        
        $manager->flush();
    }
}