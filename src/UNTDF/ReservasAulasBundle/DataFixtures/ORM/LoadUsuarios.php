<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use UNTDF\ReservasAulasBundle\Entity\User;

class LoadUsuarios extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {        
        $usuarios = array( 
            array( 
                'nombre' => 'admin',
                'password' => 'password',
                'email' => 'admin@untdf.edu.ar'
            ),
            array( 
                'nombre' => 'usuario',
                'password' => 'password',
                'email' => 'usuario@untdf.edu.ar'
            ),
        );
    
        foreach( $usuarios as $usuarioValue ){
                        
            $usuario = new User();
            $usuario->setUsername($usuarioValue['nombre']);
            $usuario->setPassword($usuarioValue['password']);
            $usuario->setEmail($usuarioValue['email']);
            
            $this->addReference( 'usuario-' . $usuarioValue['nombre'], $usuario);
                        
            $manager->persist($usuario);
        }    
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 1;
    }
}