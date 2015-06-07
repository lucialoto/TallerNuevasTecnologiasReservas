<?php
namespace UNTDF\ReservasAulasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 *  @ORM\Table(name="actividad")
 *  @ORM\Entity */
class Actividad extends Evento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
}

