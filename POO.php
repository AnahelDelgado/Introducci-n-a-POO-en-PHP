<?php

// Definición de la interfaz para el cálculo del costo de reparación
interface CostoReparacionCalculable {
    public function calcularCostoReparacion();
}

// Clase abstracta para representar a una Persona
abstract class Persona {
    protected $nombre;
    protected $edad;

    //Constante
    const NACIONALIDAD = "Española";

    public function __construct($nombre, $edad) {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    // Método abstracto que debe ser implementado por las clases hijas
    abstract public function obtenerDetalles();
}

// Clase Mecanico que hereda de Persona e implementa la interfaz CostoReparacionCalculable
class Mecanico extends Persona implements CostoReparacionCalculable {
    private $tarifaPorHora;

    //Atributo estático
    private static $totalMecanicos = 0;

    public function __construct($nombre, $edad, $tarifaPorHora) {
        parent::__construct($nombre, $edad);
        $this->tarifaPorHora = $tarifaPorHora;
        self::$totalMecanicos++;
    }

    // Implementación del método de la interfaz
    public function calcularCostoReparacion() {
        // Lógica para calcular el costo de reparación
        return $this->tarifaPorHora * 8; // Suponiendo 8 horas de trabajo
    }

    // Método final
    final public function obtenerDetalles() {
        return "Mecánico: {$this->nombre}, Edad: {$this->edad}, Tarifa por hora: {$this->tarifaPorHora}\n";
    }

    // Método estático
    public static function obtenerTotalMecanicos() {
        return self::$totalMecanicos;
    }

    // Destructor
    public function __destruct() {
        echo "Mecánico {$this->nombre} ha sido eliminado.";
        self::$totalMecanicos--;
    }
}

// Clase Dueno que hereda de Persona
class Duenio extends Persona {
    private $vehiculos = [];

    public function agregarVehiculo(Vehiculo $vehiculo) {
        $this->vehiculos[] = $vehiculo;
        echo "{$this->nombre} ha adquirido un vehículo: {$vehiculo->obtenerInformacion()}";
    }

    public function obtenerVehiculos() {
        return $this->vehiculos;
    }

    public function obtenerDetalles() {
        return "Dueño: {$this->nombre}, Edad: {$this->edad}, Nacionalidad: " . parent::NACIONALIDAD;
    }
}

// Clase Vehiculo
class Vehiculo {
    private $marca;
    private $modelo;
    private $numeroSerie;
    private $mecanicoAsignado;

    public function __construct($marca, $modelo, $numeroSerie) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->numeroSerie = $numeroSerie;
    }

    public function asignarMecanico(Mecanico $mecanico) {
        $this->mecanicoAsignado = $mecanico;
    }

    public function obtenerInformacion() {
        return "Marca: {$this->marca}, Modelo: {$this->modelo}, Número de Serie: {$this->numeroSerie}\n";
    }

    public function obtenerMecanicoAsignado() {
        return $this->mecanicoAsignado;
    }

    // Serialización de objetos
    public function __sleep() {
        return ['marca', 'modelo', 'numeroSerie'];
    }

    public function __wakeup() {
        echo "Vehículo ha sido deserializado.\n";
    }
}

// Creación de objetos
$mecanico1 = new Mecanico("Carlos", 28, 30);
$mecanico2 = new Mecanico("Pedro", 20, 24);
$duenio1 = new Duenio("Juan", 40);

$vehiculo1 = new Vehiculo("Toyota", "Starlet", "121212");
$vehiculo2 = new Vehiculo("Honda", "Civic", "343434");

// Asignación de mecánico y dueño a los vehículos
$vehiculo1->asignarMecanico($mecanico1);
$duenio1->agregarVehiculo($vehiculo1);

$vehiculo2->asignarMecanico($mecanico2);
$duenio1->agregarVehiculo($vehiculo2);

// Mostrar detalles de los objetos
echo $mecanico1->obtenerDetalles() . "";
echo $duenio1->obtenerDetalles() . "\n";

echo "Detalles del vehículo 1: " . $vehiculo1->obtenerInformacion() . "- Mecánico asignado: " . $vehiculo1->obtenerMecanicoAsignado()->obtenerDetalles() . "\n";
echo "Detalles del vehículo 2: " . $vehiculo2->obtenerInformacion() . "- Mecánico asignado: " . $vehiculo2->obtenerMecanicoAsignado()->obtenerDetalles() . "\n";

// Uso de método estático
echo "Total de mecánicos: " . Mecanico::obtenerTotalMecanicos() . "\n";

// Serialización y deserialización de objetos
$serializado = serialize($duenio1);
$deserializado = unserialize($serializado);
echo "Dueño deserializado: " . $deserializado->obtenerDetalles() . "\n";
?>