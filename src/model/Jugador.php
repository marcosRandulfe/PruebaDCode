<?php

namespace Duacode\Marcosrandulfe\model;

class Jugador
{
    private $id;
    private $nombre;
    private $numero;
    private $equipo;
    private $esCapitan;


    /**
     * Constructor
     *
     * @param int $id
     * @param string $nombre
     * @param int $numero
     * @param Equipo $equipo
     * @param boolean $esCapitan
     */
    public function __construct($id, $nombre, $numero, $equipo, $esCapitan)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->equipo = $equipo;
        $this->esCapitan = $esCapitan;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return Equipo
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * @param Equipo $equipo
     */
    public function setEquipo(Equipo $equipo)
    {
        $this->equipo = $equipo;
    }

    /**
     * @return boolean
     */
    public function isCapitan()
    {
        return $this->esCapitan;
    }

    /**
     * @param boolean $esCapitan
     *
     */
    public function setCapitan($esCapitan)
    {
        $this->esCapitan = $esCapitan;
    }
}