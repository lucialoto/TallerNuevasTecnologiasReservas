<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Doctrine\Common\Persistence\ObjectManager;

use UNTDF\ReservasAulasBundle\Entity\Curso;

class LoadCurso extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $curso = array( 
            array( 
                'nombre' => 'Taller de nuevas tecnilogías',
                'anio' => 4,
                'cantHoras' => 90,
                'carreras' => 'Licenciatura en sistemas'
            ),
            array( 
                'nombre' => 'Álgebra',
                'anio' => 1,
                'cantHoras' => 135,
                'carreras' => 'Licenciatura en sistemas'
            ),    
            array( 
                'nombre' => 'Estadística',
                'anio' => 2,
                'cantHoras' => 90,
                'carreras' => 'Técnico contable'
            ),           
        );
        
        foreach( $curso as $cursoValue ){
                        
            $curso = new Curso();
            $curso->setNombre($cursoValue['nombre']);               
            $curso->setAnio($cursoValue['anio']);
            $curso->setCantHoras($cursoValue['cantHoras']);
            $curso->addCarreras($this->getReference($cursoValue['carreras']));
            $manager->persist($curso);
        }
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}