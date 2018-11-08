<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presentacion
 *
 * @ORM\Table(name="presentacion", indexes={@ORM\Index(name="fk_presentacion_usuario1_idx", columns={"usuario_idUsuario"})})
 * @ORM\Entity
 */
class Presentacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPresentacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpresentacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombres", type="string", length=45, nullable=true)
     */
    private $nombres = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=45, nullable=true)
     */
    private $apellidos = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNac", type="date", nullable=true)
     */
    private $fechanac = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="nombresPapa", type="string", length=50, nullable=true)
     */
    private $nombrespapa = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="nombresMama", type="string", length=50, nullable=true)
     */
    private $nombresmama = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPresentacion", type="date", nullable=true)
     */
    private $fechapresentacion = 'NULL';

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_idUsuario", referencedColumnName="idUsuario")
     * })
     */
    private $usuariousuario;



    /**
     * Get idpresentacion
     *
     * @return integer
     */
    public function getIdpresentacion()
    {
        return $this->idpresentacion;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     *
     * @return Presentacion
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Presentacion
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set fechanac
     *
     * @param \DateTime $fechanac
     *
     * @return Presentacion
     */
    public function setFechanac($fechanac)
    {
        $this->fechanac = $fechanac;

        return $this;
    }

    /**
     * Get fechanac
     *
     * @return \DateTime
     */
    public function getFechanac()
    {
        return $this->fechanac;
    }

    /**
     * Set nombrespapa
     *
     * @param string $nombrespapa
     *
     * @return Presentacion
     */
    public function setNombrespapa($nombrespapa)
    {
        $this->nombrespapa = $nombrespapa;

        return $this;
    }

    /**
     * Get nombrespapa
     *
     * @return string
     */
    public function getNombrespapa()
    {
        return $this->nombrespapa;
    }

    /**
     * Set nombresmama
     *
     * @param string $nombresmama
     *
     * @return Presentacion
     */
    public function setNombresmama($nombresmama)
    {
        $this->nombresmama = $nombresmama;

        return $this;
    }

    /**
     * Get nombresmama
     *
     * @return string
     */
    public function getNombresmama()
    {
        return $this->nombresmama;
    }

    /**
     * Set fechapresentacion
     *
     * @param \DateTime $fechapresentacion
     *
     * @return Presentacion
     */
    public function setFechapresentacion($fechapresentacion)
    {
        $this->fechapresentacion = $fechapresentacion;

        return $this;
    }

    /**
     * Get fechapresentacion
     *
     * @return \DateTime
     */
    public function getFechapresentacion()
    {
        return $this->fechapresentacion;
    }

    /**
     * Set usuariousuario
     *
     * @param \AppBundle\Entity\Usuario $usuariousuario
     *
     * @return Presentacion
     */
    public function setUsuariousuario(\AppBundle\Entity\Usuario $usuariousuario = null)
    {
        $this->usuariousuario = $usuariousuario;

        return $this;
    }

    /**
     * Get usuariousuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuariousuario()
    {
        return $this->usuariousuario;
    }
}
