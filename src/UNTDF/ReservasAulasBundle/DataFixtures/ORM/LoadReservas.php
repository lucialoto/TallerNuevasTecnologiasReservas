<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use UNTDF\ReservasAulasBundle\Entity\Reserva;

class LoadReservas implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {        
        $reservas = array( 
            array( 
                'aula' => 'Aula H',
                'docente' => 'Mussolini',
                'estado' => 'solicitado',
                'evento' => 'Programacion',
                'fecha' => (new \DateTime('now')),
                'horadesde' => '08:00:00',
                'horahasta' => '09:00:00',
                'observacion' => 'S/O',
                'recurso' => 'Acceso a Internet',
                'reservafecha' => (new \DateTime('now')),
                'reservausuario' => 'usuario'
            ),
            array( 
                'aula' => 'Aula 10',
                'docente' => 'Maria Teresa',
                'estado' => 'solicitado',
                'evento' => 'Conservacion y restauracion',
                'fecha' => (new \DateTime('now')),
                'horadesde' => '08:00:00',
                'horahasta' => '10:00:00',
                'observacion' => 'S/O',
                'recurso' => 'Acceso a Internet',
                'reservafecha' => (new \DateTime('now')),
                'reservausuario' => 'usuario'
            ),
            array( 
                'aula' => 'Aula H',
                'docente' => 'Albert Einstein',
                'estado' => 'solicitado',
                'evento' => 'Seguridad e higiene',
                'fecha' => (new \DateTime('now')),
                'horadesde' => '12:00:00',
                'horahasta' => '14:00:00',
                'observacion' => 'S/O',
                'recurso' => 'Acceso a Internet',
                'reservafecha' => (new \DateTime('now')),
                'reservausuario' => 'admin'
            ),
        );
        
        foreach( $reservas as $reservaValue ){
                        
            $reserva = new Reserva();
            $reserva->setAula($this->getReference('aula-' . $reservaValue['aula']));
            $reserva->setDocente($this->getReference('docente-' . $reservaValue['docente']));
            $reserva->setEstado($reservaValue['estado']);
            $reserva->setEvento($this->getReference('evento-' . $reservaValue['evento']));
            $reserva->setFecha($reservaValue['fecha']);
            $reserva->setHoradesde($reservaValue['horadesde']);
            $reserva->setHorahasta($reservaValue['horahasta']);
            $reserva->setObservacion($reservaValue['observacion']);
            $reserva->setReservafecha($reservaValue['reservafecha']);
            $reserva->setReservausuario($this->getReference('usuario-' . $reservaValue['reservausuario']));
            $reserva->addRecursos($this->getReference('recurso-' . $reservaValue['recurso']));
            $manager->persist($reserva);
        }
        
        $manager->flush();
    }
        
    public function getOrder()
    {
        return 3;
    }
}