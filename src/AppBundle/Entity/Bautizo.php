<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bautizo
 *
 * @ORM\Table(name="bautizo", indexes={@ORM\Index(name="fk_Bautizo_miembro1_idx", columns={"miembro_idMiembro"})})
 * @ORM\Entity
 */
class Bautizo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idBautizo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbautizo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha = 'NULL';

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
     * Get idbautizo
     *
     * @return integer
     */
    public function getIdbautizo()
    {
        return $this->idbautizo;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Bautizo
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
     * Set miembromiembro
     *
     * @param \AppBundle\Entity\Miembro $miembromiembro
     *
     * @return Bautizo
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
}
