<?php

class Medico {
    private $cmp;
    private $nombre;
    private $apellido;
    private $especialidad;
    
    public function getCmp() {
        return $this->cmp;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getEspecialidad() {
        return $this->especialidad;
    }

    public function setCmp($cmp): void {
        $this->cmp = $cmp;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido): void {
        $this->apellido = $apellido;
    }

    public function setEspecialidad($especialidad): void {
        $this->especialidad = $especialidad;
    }


}
