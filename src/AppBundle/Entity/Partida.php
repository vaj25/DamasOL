<?php
// src/AppBundle/Entity/Partidas.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Alberto Castaneda
 * @ORM\Entity
 * @ORM\Table(name="partida")
 */
class Partida {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="DetallePartida", mappedBy="partida")
     */
    protected $detallePartida;

    /**
     * @ORM\Column(name="jugador_1", type="integer")
     */
    private $jugador1;

    /**
     * @ORM\Column(name="jugador_2", type="integer", nullable=true)
     */
    private $jugador2;

    /**
     * @ORM\Column(name="ganador", type="integer", nullable=true)
     */
    private $ganador;

    /**
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->detallePartida = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set jugador1
     *
     * @param integer $jugador1
     *
     * @return Partida
     */
    public function setJugador1($jugador1)
    {
        $this->jugador1 = $jugador1;

        return $this;
    }

    /**
     * Get jugador1
     *
     * @return integer
     */
    public function getJugador1()
    {
        return $this->jugador1;
    }

    /**
     * Set jugador2
     *
     * @param integer $jugador2
     *
     * @return Partida
     */
    public function setJugador2($jugador2)
    {
        $this->jugador2 = $jugador2;

        return $this;
    }

    /**
     * Get jugador2
     *
     * @return integer
     */
    public function getJugador2()
    {
        return $this->jugador2;
    }

    /**
     * Set ganador
     *
     * @param integer $ganador
     *
     * @return Partida
     */
    public function setGanador($ganador)
    {
        $this->ganador = $ganador;

        return $this;
    }

    /**
     * Get ganador
     *
     * @return integer
     */
    public function getGanador()
    {
        return $this->ganador;
    }

    /**
     * Set fecha
     *
     * @param integer $fecha
     *
     * @return Partida
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return integer
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Partida
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add detallePartida
     *
     * @param \AppBundle\Entity\DetallePartida $detallePartida
     *
     * @return Partida
     */
    public function addDetallePartida(\AppBundle\Entity\DetallePartida $detallePartida)
    {
        $this->detallePartida[] = $detallePartida;

        return $this;
    }

    /**
     * Remove detallePartida
     *
     * @param \AppBundle\Entity\DetallePartida $detallePartida
     */
    public function removeDetallePartida(\AppBundle\Entity\DetallePartida $detallePartida)
    {
        $this->detallePartida->removeElement($detallePartida);
    }

    /**
     * Get detallePartida
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetallePartida()
    {
        return $this->detallePartida;
    }
}
