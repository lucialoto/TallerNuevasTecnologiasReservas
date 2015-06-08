<?php
namespace UNTDF\ReservasAulasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 *  @ORM\Table(name="curso")
 *  @ORM\Entity */
class Curso extends Evento
{
   /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
   private $id;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="anio", type="integer")
     */
    private $anio;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="cantHoras", type="integer")
     */
    private $cantHoras;
    
}

