<?php
namespace UNTDF\ReservasAulasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UNTDF\ReservasAulasBundle\Entity\TipoActividad;
use Doctrine\Common\Collections\ArrayCollection;

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
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoActividad", inversedBy="actividades")
     * @ORM\JoinColumn(name="tipoactividad_id", referencedColumnName="id")
     */
    protected $tipoactividad;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function setTipoActividad($tipoactividad)
    {
        $this->tipoactividad = $tipoactividad;

        return $this;
    }

    
    public function getTipoActividad()
    {
        return $this->tipoactividad;
    }

    public function getHorasMinimas(){
        return $this->tipoactividad->getCantidadHoras();
    }
     
}

