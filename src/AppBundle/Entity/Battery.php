<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Battery
 *
 * @ORM\Table(name="battery")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BatteryRepository")
 */
class Battery
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="batteryType", type="string", length=255)
     */
    private $batteryType;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Battery
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set batteryType
     *
     * @param string $batteryType
     *
     * @return Battery
     */
    public function setBatteryType($batteryType)
    {
        $this->batteryType = $batteryType;

        return $this;
    }

    /**
     * Get batteryType
     *
     * @return string
     */
    public function getBatteryType()
    {
        return $this->batteryType;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return Battery
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}
