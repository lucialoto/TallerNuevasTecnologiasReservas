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
            $usuario->setPassword($usuarioValue['email']);
            
            $this->addReference( 'usuario-' . $usuarioValue['nombre'], $usuario);
                        
            $manager->persist($usuario);
        }    
        
        $manager->flush();
    }
}