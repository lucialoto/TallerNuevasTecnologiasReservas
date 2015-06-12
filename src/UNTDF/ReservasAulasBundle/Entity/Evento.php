<?php
namespace UNTDF\ReservasAulasBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass */
abstract class Evento
{
    
    /** @ORM\Column(type="string") */
    protected $nombre;
    
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function __toString()
    {
        return $this->getNombre();
    }
    
}

