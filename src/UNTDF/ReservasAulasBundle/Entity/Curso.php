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
   protected $id;
    
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
    
    public function getId() {
        return $this->id;
    }

    public function getAnio() {
        return $this->anio;
    }

    public function getCantHoras() {
        return $this->cantHoras;
    }

    public function setAnio($anio) {
        $this->anio = $anio;
    }

    public function setCantHoras($cantHoras) {
        $this->cantHoras = $cantHoras;
    }

    public function getHorasMinimas(){
        return $this->cantHoras;
    }

}

