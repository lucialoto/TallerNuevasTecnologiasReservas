<?php

namespace UNTDF\ReservasAulasBundle\DataFixtures\ORM;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

// use UNTDF\ReservasAulasBundle\Entity\User;

class LoadUsuarios extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {        
        $usuarios = array( 
            array( 
                'nombre' => 'admin',
                'password' => 'password',
                'email' => 'admin@untdf.edu.ar',
                'rol' => 'ROLE_SUPER_ADMIN'
            ),
            array( 
                'nombre' => 'usuario',
                'password' => 'password',
                'email' => 'usuario@untdf.edu.ar',
                'rol' => 'ROLE_USER'
            ),
        );
    
        $userManager = $this->container->get('fos_user.user_manager');
                
        foreach( $usuarios as $usuarioValue ){
                        
            $usuario = $userManager->createUser();
            $usuario->setUsername($usuarioValue['nombre']);
            $usuario->setPlainPassword($usuarioValue['password']);
            $usuario->setEmail($usuarioValue['email']);
            $usuario->setRoles(array($usuarioValue['rol']));
            $usuario->setEnabled(true);
                    
            $this->addReference( 'usuario-' . $usuarioValue['nombre'], $usuario);
                        
            $userManager->updateUser($usuario, true);
            
            //$manager->persist($usuario);
        }    
        
        //$manager->flush();
    }
    
    public function getOrder()
    {
        return 1;
    }
}