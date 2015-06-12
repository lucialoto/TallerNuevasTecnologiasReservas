<?php

namespace UNTDF\ReservasAulasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TipoActividad
 * @ORM\Table(name="tipoActividad")
 * @ORM\Entity
 */
class TipoActividad
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var integer
     * @ORM\Column(name="cantidadHoras", type="integer")
     */
    private $cantidadHoras;
    
    
    /* 
    * @ORM\OneToMany(targetEntity="Actividad", mappedBy="tipoactividad")
    */
    protected $actividades;
    
    function __construct() {
        
        $this->actividades = new ArrayCollection();
        
    }

        /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return TipoActividad
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set cantidadHoras
     *
     * @param integer $cantidadHoras
     * @return TipoActividad
     */
    public function setCantidadHoras($cantidadHoras)
    {
        $this->cantidadHoras = $cantidadHoras;

        return $this;
    }

    /**
     * Get cantidadHoras
     *
     * @return integer 
     */
    public function getCantidadHoras()
    {
        return $this->cantidadHoras;
    }
    
    public function __toString()
    {
        return $this->getNombre();
    }
}
