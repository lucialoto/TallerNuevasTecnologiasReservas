<?php
namespace UNTDF\ReservasAulasBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="evento")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="tipo_evento", type="string", length=20)
 * @ORM\DiscriminatorMap({"actividad"="Actividad","curso"="Curso"})
 */
abstract class Evento
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    protected $nombre;

    /**
    * @ORM\OneToMany(targetEntity="Reserva", mappedBy="evento")
    */
    protected $reservas;

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getHorasMinimas(){
        
    }
    
    public function __toString()
    {
        return $this->getNombre();
    }
    
}
