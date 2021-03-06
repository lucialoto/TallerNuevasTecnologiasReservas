<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use UNTDF\ReservasAulasBundle\Entity\Docente;

class LoadDocente extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $docentes = array(
            Array(
                'nombre' => 'Stalin',
                'dni' => 3
            ),
            Array(
                'nombre' => 'Mussolini',
                'dni' => 4
            ),
            Array(
                'nombre' => 'Maria Teresa',
                'dni' => 8
            ),
            Array(
                'nombre' => 'Albert Einstein',
                'dni' => 1
            ),
        );

        foreach ($docentes as $docenteValue) {

            $docente = new Docente();
            $docente->setNombre($docenteValue['nombre']);
            $docente->setDni($docenteValue['dni']);
            
            $this->addReference( 'docente-' . $docenteValue['nombre'], $docente);          

            $manager->persist($docente);
        }

        $manager->flush();
    }
    
    public function getOrder()
    {
        return 1;
    }
}


