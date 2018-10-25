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
     * @ORM\Column(name="Nombres", type="string", length=45, nullable=true)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="Apellidos", type="string", length=45, nullable=true)
     */
    private $apellidos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaNac", type="date", nullable=true)
     */
    private $fechaNac;

    /**
     * @var string
     *
     * @ORM\Column(name="NombresPapa", type="string", length=45, nullable=true)
     */
    private $nombresPapa;

    /**
     * @var string
     *
     * @ORM\Column(name="NombresMama", type="string", length=45, nullable=true)
     */
    private $nombresMama;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaPresentacion", type="date", nullable=true)
     */
    private $fechaPresentacion;

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
     * Set fechaNac
     *
     * @param \DateTime $fechaNac
     *
     * @return Presentacion
     */
    public function setFechaNac($fechaNac)
    {
        $this->fechaNac = $fechaNac;

        return $this;
    }

    /**
     * Get fechaNac
     *
     * @return \DateTime
     */
    public function getFechaNac()
    {
        return $this->fechaNac;
    }

    /**
     * Set nombresPapa
     *
     * @param string $nombresPapa
     *
     * @return Presentacion
     */
    public function setNombresPapa($nombresPapa)
    {
        $this->nombresPapa = $nombresPapa;

        return $this;
    }

    /**
     * Get nombresPapa
     *
     * @return string
     */
    public function getNombresPapa()
    {
        return $this->nombresPapa;
    }

    /**
     * Set nombresMama
     *
     * @param string $nombresMama
     *
     * @return Presentacion
     */
    public function setNombresMama($nombresMama)
    {
        $this->nombresMama = $nombresMama;

        return $this;
    }

    /**
     * Get nombresMama
     *
     * @return string
     */
    public function getNombresMama()
    {
        return $this->nombresMama;
    }

    /**
     * Set fechaPresentacion
     *
     * @param \DateTime $fechaPresentacion
     *
     * @return Presentacion
     */
    public function setFechaPresentacion($fechaPresentacion)
    {
        $this->fechaPresentacion = $fechaPresentacion;

        return $this;
    }

    /**
     * Get fechaPresentacion
     *
     * @return \DateTime
     */
    public function getFechaPresentacion()
    {
        return $this->fechaPresentacion;
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
