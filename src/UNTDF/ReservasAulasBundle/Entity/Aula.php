<?php

namespace UNTDF\ReservasAulasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aula
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Aula
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="Edificio", inversedBy="aulas")
     * @ORM\JoinColumn(name="edificio_id", referencedColumnName="id")
     */
    protected $edificio;

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
     * @return Aula
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
     * Set edificioId
     *
     * @param integer $edificio
     * @return Aula
     */
    public function setEdificio($edificio)
    {
        $this->edificio = $edificio;

        return $this;
    }

    /**
     * Get edificioId
     *
     * @return integer 
     */
    public function getEdificio()
    {
        return $this->edificio;
    }
}
