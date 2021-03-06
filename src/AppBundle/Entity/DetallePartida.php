<?php
// src/AppBundle/Entity/DetallePartidas.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Alberto Castaneda
 * @ORM\Entity
 * @ORM\Table(name="detalle_partida")
 */
class DetallePartida {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Partida", inversedBy="detallePartida")
     * @ORM\JoinColumn(name="id_partida", referencedColumnName="id")
     */
    private $partida;

    /**
     * @ORM\Column(name="position_x", type="integer")
     */
    private $posicionX;

    /**
     * @ORM\Column(name="position_y", type="integer")
     */
    private $posicionY;

    /**
     * @ORM\Column(name="nueva_position_x", type="integer")
     */
    private $nvaPosicionX;

    /**
     * @ORM\Column(name="nueva_position_y", type="integer")
     */
    private $nvaPosicionY;

    /**
     * @ORM\Column(name="captura_x", type="integer", nullable=true)
     */
    private $capturaX;

    /**
     * @ORM\Column(name="captura_y", type="integer", nullable=true)
     */
    private $capturaY;

    /**
     * @ORM\Column(name="color", type="string", length=25)
     */
    private $color;

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
     * Set posicionX
     *
     * @param integer $posicionX
     *
     * @return DetallePartida
     */
    public function setPosicionX($posicionX)
    {
        $this->posicionX = $posicionX;

        return $this;
    }

    /**
     * Get posicionX
     *
     * @return integer
     */
    public function getPosicionX()
    {
        return $this->posicionX;
    }

    /**
     * Set posicionY
     *
     * @param integer $posicionY
     *
     * @return DetallePartida
     */
    public function setPosicionY($posicionY)
    {
        $this->posicionY = $posicionY;

        return $this;
    }

    /**
     * Get posicionY
     *
     * @return integer
     */
    public function getPosicionY()
    {
        return $this->posicionY;
    }

    /**
     * Set nvaPosicionX
     *
     * @param integer $nvaPosicionX
     *
     * @return DetallePartida
     */
    public function setNvaPosicionX($nvaPosicionX)
    {
        $this->nvaPosicionX = $nvaPosicionX;

        return $this;
    }

    /**
     * Get nvaPosicionX
     *
     * @return integer
     */
    public function getNvaPosicionX()
    {
        return $this->nvaPosicionX;
    }

    /**
     * Set nvaPosicionY
     *
     * @param integer $nvaPosicionY
     *
     * @return DetallePartida
     */
    public function setNvaPosicionY($nvaPosicionY)
    {
        $this->nvaPosicionY = $nvaPosicionY;

        return $this;
    }

    /**
     * Get nvaPosicionY
     *
     * @return integer
     */
    public function getNvaPosicionY()
    {
        return $this->nvaPosicionY;
    }

    /**
     * Set capturaX
     *
     * @param integer $capturaX
     *
     * @return DetallePartida
     */
    public function setCapturaX($capturaX)
    {
        $this->capturaX = $capturaX;

        return $this;
    }

    /**
     * Get capturaX
     *
     * @return integer
     */
    public function getCapturaX()
    {
        return $this->capturaX;
    }

    /**
     * Set capturaY
     *
     * @param integer $capturaY
     *
     * @return DetallePartida
     */
    public function setCapturaY($capturaY)
    {
        $this->capturaY = $capturaY;

        return $this;
    }

    /**
     * Get capturaY
     *
     * @return integer
     */
    public function getCapturaY()
    {
        return $this->capturaY;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return DetallePartida
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set partida
     *
     * @param \AppBundle\Entity\Partida $partida
     *
     * @return DetallePartida
     */
    public function setPartida(\AppBundle\Entity\Partida $partida = null)
    {
        $this->partida = $partida;

        return $this;
    }

    /**
     * Get partida
     *
     * @return \AppBundle\Entity\Partida
     */
    public function getPartida()
    {
        return $this->partida;
    }
}
