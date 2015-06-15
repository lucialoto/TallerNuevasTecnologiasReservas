<?php

namespace UNTDF\ReservasAulasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use UNTDF\ReservasAulasBundle\Entity\Aula;
use UNTDF\ReservasAulasBundle\Entity\Docente;
use UNTDF\ReservasAulasBundle\Entity\Evento;
use UNTDF\ReservasAulasBundle\Entity\Recurso;
use UNTDF\ReservasAulasBundle\Entity\User;


/**
 * Reserva
 *
 * @ORM\Table(name="reserva")
 * @ORM\Entity
 */
class Reserva
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
     * @ORM\ManyToOne(targetEntity="Aula")
     * @ORM\JoinColumn(name="aula_id", referencedColumnName="id")
     */
    protected $aula;
    /**
     * @ORM\ManyToOne(targetEntity="Docente")
     * @ORM\JoinColumn(name="docente_id", referencedColumnName="id")
     */
    protected $docente;
    
     /**
     * @ORM\ManyToMany(targetEntity="Recurso")
     * @ORM\JoinTable(name="reserva_recursos",
     *      joinColumns={@ORM\JoinColumn(name="reserva_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="recurso_id", referencedColumnName="id")}
     *      )
     **/
    protected $recursos;
 
    /**
     * @ORM\Column(type="date")
     */
    protected $fecha;
    /**
     * @ORM\Column(type="time")
     */
    protected $horadesde;
    /**
     * @ORM\Column(type="time")
     */
    protected $horahasta;
    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $estado;
    /**
     * @ORM\Column(type="text")
     */
    protected $observacion;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="reserva_usuario_id", referencedColumnName="id")
     */
    protected $reservausuario;
    /**
     * @ORM\Column(type="date")
     */
    protected $reservafecha;
    
    /**
     * @ORM\ManyToOne(targetEntity="Evento", inversedBy="reservas")
     * @ORM\JoinColumn(name="evento_id", referencedColumnName="id")
     */
    protected $evento;

    public function __construct()
    {
        $this->recursos = new ArrayCollection();
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
     * Set evento
     *
     * @param \stdClass $evento
     * @return Reserva
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * Get evento
     *
     * @return \stdClass 
     */
    public function getEvento()
    {
        return $this->evento;
    }

    public function getAula() {
        return $this->aula;
    }

    public function setAula($aula) {
        $this->aula = $aula;
    }
    
    public function getDocente() {
        return $this->docente;
    }

    public function setDocente($docente) {
        $this->docente = $docente;
    }

    public function getRecursos() {
        return $this->recursos;
    }

    public function setRecursos($recursos) {
        $this->recursos = $recursos;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getFecha() {
        return $this->fecha;
    }
    
    public function setHoradesde($horadesde) {
        $this->horadesde = $horadesde;
    }

    public function getHoradesde() {
        return $this->horadesde;
    }

    public function setHorahasta($horahasta) {
        $this->horahasta = $horahasta;
    }

    public function getHorahasta() {
        return $this->horahasta;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getObservacion() {
        return $this->observacion;
    }

    public function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

    public function getReservausuario() {
        return $this->reservausuario;
    }

    public function setReservausuario($reservausuario) {
        $this->reservausuario = $reservausuario;
    }

    public function getReservafecha() {
        return $this->reservafecha;
    }

    public function setReservafecha($reservafecha) {
        $this->reservafecha = $reservafecha;
    }
        
}
