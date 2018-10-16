<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Miembro
 *
 * @ORM\Table(name="miembro", indexes={@ORM\Index(name="fk_RegistroMiembro_Usuario1_idx", columns={"Usuario_idUsuario"}), @ORM\Index(name="fk_miembro_ministerio1_idx", columns={"ministerio_idMinisterio"})})
 * @ORM\Entity
 */
class Miembro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idMiembro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmiembro;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombres", type="string", length=50, nullable=true)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="Apellidos", type="string", length=40, nullable=true)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="estadoCivil", type="string", length=10, nullable=true)
     */
    private $estadoCivil;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNac", type="date", nullable=true)
     */
    private $fechaNac;

    /**
     * @var string
     *
     * @ORM\Column(name="genero", type="string", length=10, nullable=true)
     */
    private $genero;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=45, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoFijo", type="string", length=20, nullable=true)
     */
    private $telefonoFijo;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoMovil", type="string", length=20, nullable=true)
     */
    private $telefonoMovil;

    /**
     * @var string
     *
     * @ORM\Column(name="nacionalidad", type="string", length=45, nullable=true)
     */
    private $nacionalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="profesion", type="string", length=45, nullable=true)
     */
    private $profesion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAceptacion", type="date", nullable=true)
     */
    private $fechaAceptacion;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Usuario_idUsuario", referencedColumnName="idUsuario")
     * })
     */
    private $usuariousuario;

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
     * Get idmiembro
     *
     * @return integer
     */
    public function getIdmiembro()
    {
        return $this->idmiembro;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     *
     * @return Miembro
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
     * @return Miembro
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
     * Set estadoCivil
     *
     * @param string $estadoCivil
     *
     * @return Miembro
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get estadoCivil
     *
     * @return string
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Set fechaNac
     *
     * @param \DateTime $fechaNac
     *
     * @return Miembro
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
     * Set genero
     *
     * @param string $genero
     *
     * @return Miembro
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero
     *
     * @return string
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Miembro
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Miembro
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefonoFijo
     *
     * @param string $telefonoFijo
     *
     * @return Miembro
     */
    public function setTelefonoFijo($telefonoFijo)
    {
        $this->telefonoFijo = $telefonoFijo;

        return $this;
    }

    /**
     * Get telefonoFijo
     *
     * @return string
     */
    public function getTelefonoFijo()
    {
        return $this->telefonoFijo;
    }

    /**
     * Set telefonoMovil
     *
     * @param string $telefonoMovil
     *
     * @return Miembro
     */
    public function setTelefonoMovil($telefonoMovil)
    {
        $this->telefonoMovil = $telefonoMovil;

        return $this;
    }

    /**
     * Get telefonoMovil
     *
     * @return string
     */
    public function getTelefonoMovil()
    {
        return $this->telefonoMovil;
    }

    /**
     * Set nacionalidad
     *
     * @param string $nacionalidad
     *
     * @return Miembro
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return string
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set profesion
     *
     * @param string $profesion
     *
     * @return Miembro
     */
    public function setProfesion($profesion)
    {
        $this->profesion = $profesion;

        return $this;
    }

    /**
     * Get profesion
     *
     * @return string
     */
    public function getProfesion()
    {
        return $this->profesion;
    }

    /**
     * Set fechaAceptacion
     *
     * @param \DateTime $fechaAceptacion
     *
     * @return Miembro
     */
    public function setFechaAceptacion($fechaAceptacion)
    {
        $this->fechaAceptacion = $fechaAceptacion;

        return $this;
    }

    /**
     * Get fechaAceptacion
     *
     * @return \DateTime
     */
    public function getFechaAceptacion()
    {
        return $this->fechaAceptacion;
    }

    /**
     * Set usuariousuario
     *
     * @param \AppBundle\Entity\Usuario $usuariousuario
     *
     * @return Miembro
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

    /**
     * Set ministerioministerio
     *
     * @param \AppBundle\Entity\Ministerio $ministerioministerio
     *
     * @return Miembro
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
