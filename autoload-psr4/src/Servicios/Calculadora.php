<?php

namespace App\Servicios;

class Calculadora {
    public function sumar(float $a, float $b): float {
        return $a + $b;
    }

    public function aplicarDescuento(float $precio, float $porcentaje): float {
        return $precio - ($precio * $porcentaje / 100);
    }
}