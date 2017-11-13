<?php
// src/AppBundle/Entity/Games.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Alberto Castaneda
 * @ORM\Entity
 * @ORM\Table(name="game")
 */
class Game {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="position_x", type="integer")
     */
    private $positionX;

    /**
     * @ORM\Column(name="position_y", type="integer")
     */
    private $positionY;

    /**
     * @ORM\Column(name="new_position_x", type="integer")
     */
    private $newPositionX;

    /**
     * @ORM\Column(name="new_position_y", type="integer")
     */
    private $newPositionY;

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
     * Set positionX
     *
     * @param integer $positionX
     *
     * @return Game
     */
    public function setPositionX($positionX)
    {
        $this->positionX = $positionX;

        return $this;
    }

    /**
     * Get positionX
     *
     * @return integer
     */
    public function getPositionX()
    {
        return $this->positionX;
    }

    /**
     * Set positionY
     *
     * @param integer $positionY
     *
     * @return Game
     */
    public function setPositionY($positionY)
    {
        $this->positionY = $positionY;

        return $this;
    }

    /**
     * Get positionY
     *
     * @return integer
     */
    public function getPositionY()
    {
        return $this->positionY;
    }

    /**
     * Set newPositionX
     *
     * @param integer $newPositionX
     *
     * @return Game
     */
    public function setNewPositionX($newPositionX)
    {
        $this->newPositionX = $newPositionX;

        return $this;
    }

    /**
     * Get newPositionX
     *
     * @return integer
     */
    public function getNewPositionX()
    {
        return $this->newPositionX;
    }

    /**
     * Set newPositionY
     *
     * @param integer $newPositionY
     *
     * @return Game
     */
    public function setNewPositionY($newPositionY)
    {
        $this->newPositionY = $newPositionY;

        return $this;
    }

    /**
     * Get newPositionY
     *
     * @return integer
     */
    public function getNewPositionY()
    {
        return $this->newPositionY;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Game
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
}
