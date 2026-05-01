<?php

namespace App\Modelos;

class Producto {
    private string $nombre;
    private float $precio;

    public function __construct(string $nombre, float $precio) {
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    public function mostrarInfo(): string {
        return "Producto: {$this->nombre} | Precio: $" . number_format($this->precio, 2);
    }
}