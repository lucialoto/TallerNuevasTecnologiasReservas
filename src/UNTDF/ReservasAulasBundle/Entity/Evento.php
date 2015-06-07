<?php
namespace UNTDF\ReservasAulasBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass */
abstract class Evento
{
    
    /** @ORM\Column(type="string") */
    protected $nombre;
    
}

