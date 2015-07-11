<?php
namespace UNTDF\ReservasAulasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use UNTDF\ReservasAulasBundle\Entity\Carrera;

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
    
    /**
     * @ORM\ManyToMany(targetEntity="Carrera")
     **/
    private $carreras;
    
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

    public function getCarreras()
    {
        return $this->carreras;
    }

    public function __construct()
    {
        $this->carreras = new ArrayCollection();        
    }

    public function addCarreras($carreras) {
        $this->carreras[] = $carreras;
    }

    public function obtenerListaCarreras(){
        $listacarreras = '';
        foreach ($this->carreras as $carrera) {
            if($listacarreras <> ''){
                $listacarreras = $listacarreras . ', ';     
            }
            $listacarreras = $listacursos . $carrera->getNombre();
            $listacarreras = trim($listacarreras);
        }
        return $listacarreras;
    }

}

