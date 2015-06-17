<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UNTDF\ReservasAulasBundle\Entity\Docente;

class LoadDocente implements FixtureInterface {

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

            $manager->persist($docente);
        }

        $manager->flush();
    }

}


