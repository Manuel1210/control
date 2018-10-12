<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inoutcaja
 *
 * @ORM\Table(name="inoutcaja", indexes={@ORM\Index(name="fk_inoutcaja_Caja1_idx", columns={"Caja_idCaja"}), @ORM\Index(name="fk_inoutcaja_tipotransaccion1_idx", columns={"tipotransaccion_idtipotransaccuib"})})
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
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="cantidad", type="float", precision=10, scale=0, nullable=true)
     */
    private $cantidad;

    /**
     * @var float
     *
     * @ORM\Column(name="Subtotal", type="float", precision=10, scale=0, nullable=true)
     */
    private $subtotal;

    /**
     * @var \Caja
     *
     * @ORM\ManyToOne(targetEntity="Caja")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Caja_idCaja", referencedColumnName="idCaja")
     * })
     */
    private $cajacaja;

    /**
     * @var \Tipotransaccion
     *
     * @ORM\ManyToOne(targetEntity="Tipotransaccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipotransaccion_idtipotransaccuib", referencedColumnName="idtipotransaccuib")
     * })
     */
    private $tipotransacciontipotransaccuib;



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
     * Set subtotal
     *
     * @param float $subtotal
     *
     * @return Inoutcaja
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get subtotal
     *
     * @return float
     */
    public function getSubtotal()
    {
        return $this->subtotal;
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
     * Set tipotransacciontipotransaccuib
     *
     * @param \AppBundle\Entity\Tipotransaccion $tipotransacciontipotransaccuib
     *
     * @return Inoutcaja
     */
    public function setTipotransacciontipotransaccuib(\AppBundle\Entity\Tipotransaccion $tipotransacciontipotransaccuib = null)
    {
        $this->tipotransacciontipotransaccuib = $tipotransacciontipotransaccuib;

        return $this;
    }

    /**
     * Get tipotransacciontipotransaccuib
     *
     * @return \AppBundle\Entity\Tipotransaccion
     */
    public function getTipotransacciontipotransaccuib()
    {
        return $this->tipotransacciontipotransaccuib;
    }
}
