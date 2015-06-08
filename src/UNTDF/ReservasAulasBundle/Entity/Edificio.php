<?php

namespace UNTDF\ReservasAulasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="edificio")
 */
class Edificio
{
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $nombre;

    /* 
    * @ORM\OneToMany(targetEntity="Aula", mappedBy="edificio")
    */
    protected $aulas;

    public function __construct()
    {
        $this->aulas = new ArrayCollection();
    }
    
    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function getNombre(){
        return $this->nombre;
    }

    function getId(){
        return $this->id;
    }

    public function __toString()
    {
        return $this->getNombre();
    }

}


