<?php
    //Esta será una aplicación de un taller de mecánico, donde se registrarán los vehículos que se tratan, los dueños de los mismos y los mecánicos encargados de la asistencia

    class Coche{
        private $marca;
        private $modelo;
        private $matricula;
        private $ID_Duenio;
        private $ID_Mecanico;
        private $horas_Asistencia;

        public function _construct($marca, $modelo, $matricula, $ID_Duenio, $ID_Mecanico, $horas_asistencia){
            $this->marca = $marca;
            $this->modelo = $modelo;
            $this->matricula = $matricula;
            $this->ID_Duenio = $ID_Duenio;
            $this->ID_Mecanico = $ID_Mecanico;
            $this->horas_Asistencia = $horas_Asistencia;
        }

        public function getMarca(){
            return $this->marca;
        }

        public function getModelo(){
            return $this->modelo;
        }

        public function getMatricula(){
            return $this->matricula;
        }

        public function getID_Duenio(){
            return $this->ID_Duenio;
        }

        public function getID_Mecanico(){
            return $this->ID_Mecanico;
        }

        public function getHoras_Asistencia(){
            return $this->horas_Asistencia;
        }
    }

    class Mecanico{
        private $ID;
        private $nombre;
        private $edad;

        public function _construct($ID, $nombre, $edad){
            $this->ID = $ID;
            $this->nombre = $nombre;
            $this->edad = $edad;
        }

        public function getID(){
            return $this->ID;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getEdad(){
            return $this->edad;
        }
    }

    class Duenio{
        private $ID;
        private $nombre;
        private $pago;

        public function _construct($ID, $nombre, $pago){
            $this->ID = $ID;
            $this->nombre = $nombre;
            $this->pago = $pago;
        }

        public function getID(){
            return $this->ID;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getEdad(){
            return $this->pago;
        }
    }
?>