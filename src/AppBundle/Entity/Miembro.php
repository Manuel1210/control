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
     * @ORM\Column(name="nombres", type="string", length=50, nullable=true)
     */
    private $nombres = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=40, nullable=true)
     */
    private $apellidos = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="estadoCivil", type="string", length=10, nullable=true)
     */
    private $estadocivil = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNac", type="date", nullable=true)
     */
    private $fechanac = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="genero", type="string", length=10, nullable=true)
     */
    private $genero = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    private $email = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=45, nullable=true)
     */
    private $direccion = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoFijo", type="string", length=20, nullable=true)
     */
    private $telefonofijo = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoMovil", type="string", length=20, nullable=true)
     */
    private $telefonomovil = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="nacionalidad", type="string", length=45, nullable=true)
     */
    private $nacionalidad = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="profesion", type="string", length=45, nullable=true)
     */
    private $profesion = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAceptacion", type="date", nullable=true)
     */
    private $fechaaceptacion = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado = 'NULL';

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
     * Set estadocivil
     *
     * @param string $estadocivil
     *
     * @return Miembro
     */
    public function setEstadocivil($estadocivil)
    {
        $this->estadocivil = $estadocivil;

        return $this;
    }

    /**
     * Get estadocivil
     *
     * @return string
     */
    public function getEstadocivil()
    {
        return $this->estadocivil;
    }

    /**
     * Set fechanac
     *
     * @param \DateTime $fechanac
     *
     * @return Miembro
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
     * Set telefonofijo
     *
     * @param string $telefonofijo
     *
     * @return Miembro
     */
    public function setTelefonofijo($telefonofijo)
    {
        $this->telefonofijo = $telefonofijo;

        return $this;
    }

    /**
     * Get telefonofijo
     *
     * @return string
     */
    public function getTelefonofijo()
    {
        return $this->telefonofijo;
    }

    /**
     * Set telefonomovil
     *
     * @param string $telefonomovil
     *
     * @return Miembro
     */
    public function setTelefonomovil($telefonomovil)
    {
        $this->telefonomovil = $telefonomovil;

        return $this;
    }

    /**
     * Get telefonomovil
     *
     * @return string
     */
    public function getTelefonomovil()
    {
        return $this->telefonomovil;
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
     * Set fechaaceptacion
     *
     * @param \DateTime $fechaaceptacion
     *
     * @return Miembro
     */
    public function setFechaaceptacion($fechaaceptacion)
    {
        $this->fechaaceptacion = $fechaaceptacion;

        return $this;
    }

    /**
     * Get fechaaceptacion
     *
     * @return \DateTime
     */
    public function getFechaaceptacion()
    {
        return $this->fechaaceptacion;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Miembro
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
