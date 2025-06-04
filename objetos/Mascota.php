<?php
class Mascota {
    private $nombre;
    private $tamano;
    private $color;
    private $fecNacimiento;
    private $especie;
    private $sexo;
    private $raza;
    private $vacunas;
    private $edad;

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getTamano() {
        return $this->tamano;
    }

    public function setTamano($tamano) {
        $this->tamano = $tamano;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getFecNacimiento() {
        return $this->fecNacimiento;
    }

    public function setFecNacimiento($fecNacimiento) {
        $this->fecNacimiento = $fecNacimiento;
    }

    public function getEspecie() {
        return $this->especie;
    }

    public function setEspecie($especie) {
        $this->especie = $especie;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getRaza() {
        return $this->raza;
    }

    public function setRaza($raza) {
        $this->raza = $raza;
    }

    public function getVacunas() {
        return $this->vacunas;
    }

    public function setVacunas($vacunas) {
        $this->vacunas = $vacunas;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }
}
?>
