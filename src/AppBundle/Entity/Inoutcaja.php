<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inoutcaja
 *
 * @ORM\Table(name="inoutcaja", indexes={@ORM\Index(name="fk_inoutcaja_caja1_idx", columns={"caja_idCaja"}), @ORM\Index(name="fk_inoutcaja_tipotransaccion1_idx", columns={"tipotransaccion_idtipotransaccion"})})
 * @ORM\Entity
 */
class Inoutcaja
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idIngreso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idingreso;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=4000, nullable=true)
     */
    private $descripcion = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="cantidad", type="float", precision=10, scale=0, nullable=true)
     */
    private $cantidad = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha = 'NULL';

    /**
     * @var \Caja
     *
     * @ORM\ManyToOne(targetEntity="Caja")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="caja_idCaja", referencedColumnName="idCaja")
     * })
     */
    private $cajacaja;

    /**
     * @var \Tipotransaccion
     *
     * @ORM\ManyToOne(targetEntity="Tipotransaccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipotransaccion_idtipotransaccion", referencedColumnName="idtipotransaccion")
     * })
     */
    private $tipotransacciontipotransaccion;



    /**
     * Get idingreso
     *
     * @return integer
     */
    public function getIdingreso()
    {
        return $this->idingreso;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Inoutcaja
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set cantidad
     *
     * @param float $cantidad
     *
     * @return Inoutcaja
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return float
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Inoutcaja
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set cajacaja
     *
     * @param \AppBundle\Entity\Caja $cajacaja
     *
     * @return Inoutcaja
     */
    public function setCajacaja(\AppBundle\Entity\Caja $cajacaja = null)
    {
        $this->cajacaja = $cajacaja;

        return $this;
    }

    /**
     * Get cajacaja
     *
     * @return \AppBundle\Entity\Caja
     */
    public function getCajacaja()
    {
        return $this->cajacaja;
    }

    /**
     * Set tipotransacciontipotransaccion
     *
     * @param \AppBundle\Entity\Tipotransaccion $tipotransacciontipotransaccion
     *
     * @return Inoutcaja
     */
    public function setTipotransacciontipotransaccion(\AppBundle\Entity\Tipotransaccion $tipotransacciontipotransaccion = null)
    {
        $this->tipotransacciontipotransaccion = $tipotransacciontipotransaccion;

        return $this;
    }

    /**
     * Get tipotransacciontipotransaccion
     *
     * @return \AppBundle\Entity\Tipotransaccion
     */
    public function getTipotransacciontipotransaccion()
    {
        return $this->tipotransacciontipotransaccion;
    }
}
