<?php

// Una sola línea reemplaza todos los include/require
require_once __DIR__ . '/vendor/autoload.php';

use App\Modelos\Usuario;
use App\Modelos\Producto;
use App\Servicios\Calculadora;

// Instanciar objetos sin ningún include manual
$usuario = new Usuario("Victor", "victor@utp.ac.pa");
$producto = new Producto("Laptop", 850.00);
$calc = new Calculadora();

echo $usuario->mostrarInfo() . PHP_EOL;
echo $producto->mostrarInfo() . PHP_EOL;

$precioFinal = $calc->aplicarDescuento(850.00, 10);
echo "Precio con 10% descuento: $" . number_format($precioFinal, 2) . PHP_EOL;