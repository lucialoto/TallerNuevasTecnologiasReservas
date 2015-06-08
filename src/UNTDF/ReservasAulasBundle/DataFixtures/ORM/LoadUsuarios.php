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
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPlainPassword('password');
        $userAdmin->setEmail('admin@untdf.edu.ar');
        $userAdmin->setEnabled(true);
        $userAdmin->addRole(User::ROLE_SUPER_ADMIN);
        
        $manager->persist($userAdmin);
        
        $manager->flush();
    }
}