<?php
namespace Duacode\Marcosrandulfe\model;
class Equipo
{

    private $id;
    private $nombre;
    private $ciudad;
    private $deporte;
    private $fechaFundacion;

    /**
     * @param $id
     * @param $nombre
     * @param $ciudad
     * @param $deporte
     * @param $fechaFundacion
     */
    public function __construct($id, $nombre, $ciudad, $deporte, $fechaFundacion)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ciudad = $ciudad;
        $this->deporte = $deporte;
        $this->fechaFundacion = $fechaFundacion;
    }

    /**
     * @return mixed $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * @param mixed $ciudad
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }

    /**
     * @return mixed
     */
    public function getDeporte()
    {
        return $this->deporte;
    }

    /**
     * @param mixed $deporte
     */
    public function setDeporte($deporte)
    {
        $this->deporte = $deporte;
    }

    /**
     * @return mixed
     */
    public function getFechaFundacion()
    {
        return $this->fechaFundacion;
    }

    /**
     * @param mixed $fechaFundacion
     */
    public function setFechaFundacion($fechaFundacion)
    {
        $this->fechaFundacion = $fechaFundacion;
    }


}