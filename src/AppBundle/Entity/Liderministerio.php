<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Liderministerio
 *
 * @ORM\Table(name="liderministerio", indexes={@ORM\Index(name="fk_liderministerio_ministerio1_idx", columns={"ministerio_idMinisterio"}), @ORM\Index(name="fk_liderministerio_miembro1_idx", columns={"miembro_idMiembro"})})
 * @ORM\Entity
 */
class Liderministerio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idliderministerio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idliderministerio;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado = 'NULL';

    /**
     * @var \Miembro
     *
     * @ORM\ManyToOne(targetEntity="Miembro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="miembro_idMiembro", referencedColumnName="idMiembro")
     * })
     */
    private $miembromiembro;

    /**
     * @var \Ministerio
     *
     * @ORM\ManyToOne(targetEntity="Ministerio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ministerio_idMinisterio", referencedColumnName="idMinisterio")
     * })
     */
    private $ministerioministerio;



    /**
     * Get idliderministerio
     *
     * @return integer
     */
    public function getIdliderministerio()
    {
        return $this->idliderministerio;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Liderministerio
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set miembromiembro
     *
     * @param \AppBundle\Entity\Miembro $miembromiembro
     *
     * @return Liderministerio
     */
    public function setMiembromiembro(\AppBundle\Entity\Miembro $miembromiembro = null)
    {
        $this->miembromiembro = $miembromiembro;

        return $this;
    }

    /**
     * Get miembromiembro
     *
     * @return \AppBundle\Entity\Miembro
     */
    public function getMiembromiembro()
    {
        return $this->miembromiembro;
    }

    /**
     * Set ministerioministerio
     *
     * @param \AppBundle\Entity\Ministerio $ministerioministerio
     *
     * @return Liderministerio
     */
    public function setMinisterioministerio(\AppBundle\Entity\Ministerio $ministerioministerio = null)
    {
        $this->ministerioministerio = $ministerioministerio;

        return $this;
    }

    /**
     * Get ministerioministerio
     *
     * @return \AppBundle\Entity\Ministerio
     */
    public function getMinisterioministerio()
    {
        return $this->ministerioministerio;
    }
}
