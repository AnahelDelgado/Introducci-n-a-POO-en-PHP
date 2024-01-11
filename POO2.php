<?php
    //Esta será una aplicación de un taller de mecánico, donde se registrarán los vehículos que se tratan, los dueños de los mismos y los mecánicos encargados de la asistencia

    //Primero hacemos la definición de la interfaz para el cálculo del costo de la reparación
    interface CostoReparacionCalculable{
        public function calcularCostoReparacion();
    }

    //Creamos una clase abstracta para representar a una "Persona"
    abstract class Persona{
        protected $nombre;
        protected $edad;

        //Aquí aprovechamos para declarar una constante
        const NACIONALIDAD = "Española";

        public function __construct($nombre, $edad){
            $this->nombre = $nombre;
            $this->edad = $edad;
        }

        //Añadimos un método abstracto que debe ser implementado por las clases hijas
        abstract public function obtenerDetalles();
    }

    //Ahora creamos la clase "Mecanico" que hereda de Persona e implementa la interfaz "CostoReparacioncalculable"
    class Mecanico extends Persona implements CostoReparacionCalculable{

        private $tarifaPorHora;

        //Atributo estático
        private static $totalMecanicos = 0;

        public function __construct($nombre, $edad, $tarifaPorHora){
            parent::__construct($nombre, $edad);
            $this->tarifaPorHora = $tarifaPorHora;
            self::$totalMecanicos++;
        }

        //Implementamos el método de la interfaz
        public function calcularCostoReparacion(){
            //Esta sería la lógica para calcular el costo de reparación del coche
            return $this->tarifaPorHora * 8; //Aquí estamos poniendo como ejemplo que son 8 horas de trabajo
        }

        //Añadimos un método estático
        public static function obtenerTotalMecanicos(){
            return self::$totalMecanicos;
        }

        //Añadimos un método final
        final public function obtenerDetalles(){
            return "Mecánico: {$this->nombre}, Edad: {$this->edad}, Mano de obra por hora: {$this->tarifaPorHora}";
        }

        //Añadimos un Destructor
        public function __destruct(){
            echo "Mecánico {$this->nombre} ha sido eliminado.<br>";
            self::$totalMecanicos--;
        }
    }

    //Creamos la clase "Vehiculo"
    class Vehiculo{
        private $marca;
        private $modelo;
        private $numeroSerie;
        private $mecanicoAsignado;

        //constructor de la clase
        public function __construct($marca, $modelo, $numeroSerie){
            $this->marca = $marca;
            $this->modelo = $modelo;
            $this->numeroSerie = $numeroSerie;
        }

        //Método para asignar un mecánico al vehículo
        public function asignarMecanico(Mecanico $mecanico){
            $this->mecanicoAsignado = $mecanico;
        }

        //Método para obtener la información completa del vehículo
        public function obtenerInformacion() {
            return "Marca: {$this->marca}, Modelo: {$this->modelo}, Número de Serie: {$this->numeroSerie}";
        }
    
        //método para obtener el mecánico que está asignado al vehículo
        public function obtenerMecanicoAsignado() {
            return $this->mecanicoAsignado;
        }
    
        //Método para serializar un objeto
        public function __sleep() {
            return ['marca', 'modelo', 'numeroSerie'];
        }
    
        //Método para deserializar un vehículo
        public function __wakeup() {
            echo "Vehículo ha sido deserializado.<br>";
        }
    }

    //Creamos la clase "Duenio" que hereda de Persona
class Duenio extends Persona {
    private $vehiculos = [];

    public function agregarVehiculo(Vehiculo $vehiculo) {
        $this->vehiculos[] = $vehiculo;
        echo "{$this->nombre} ha adquirido un vehículo: {$vehiculo->obtenerInformacion()}<br>";
    }

    public function obtenerVehiculos() {
        return $this->vehiculos;
    }

    public function obtenerDetalles() {
        return "Dueño: {$this->nombre}, Edad: {$this->edad}, Nacionalidad: " . parent::NACIONALIDAD;
    }
}
?>