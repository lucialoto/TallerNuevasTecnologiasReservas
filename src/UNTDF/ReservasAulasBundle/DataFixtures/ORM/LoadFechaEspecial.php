<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;

use \DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UNTDF\ReservasAulasBundle\Entity\FechaEspecial;

class LoadFechaReserva implements FixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $fechas = array(
            Array(
                'fecha' => new DateTime('2015-07-09'),
                'descripcion' => 'Día de la independencia'
            ),
            Array(
                'fecha' => new DateTime('2015-05-25'),
                'descripcion' => 'Revolución de mayo'
            ),
            Array(
                'fecha' => new DateTime('2015-04-02'),
                'descripcion' => 'Día del Veterano y caídos en Malvinas'
            ),
            Array(
                'fecha' => new DateTime('2015-06-20'),
                'descripcion' => 'Día de la Bandera'
            ),
        );

        foreach ($fechas as $fechaValue) {

            $fecha = new FechaEspecial();
            $fecha->setFecha($fechaValue['fecha']);
            $fecha->setDescripcion($fechaValue['descripcion']);

            $manager->persist($fecha);
        }

        $manager->flush();
    }

}
