<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Doctrine\Common\Persistence\ObjectManager;

use \UNTDF\ReservasAulasBundle\Entity\Edificio;

class LoadEdificios extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $edificios = array( 
            'HY' => 'Hipólito Yrigoyen 879', 
            'O' => 'Onas 450', 
            'DC' => 'Darwin y Canga'
        );
        
        foreach( $edificios as $edificioKey => $edificioValue ){
            
            $edificio = new Edificio();
            $edificio->setNombre( $edificioValue );
            
            $this->addReference( 'edificio-' . $edificioKey, $edificio);
            
            $manager->persist($edificio);
        }
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 1;
    }
}