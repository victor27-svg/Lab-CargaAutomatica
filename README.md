# 🚀 Implementación de Carga Automática (Autoload) bajo el Estándar PSR-4 con Composer

**Universidad Tecnológica de Panamá**  
Facultad de Ingeniería en Sistemas Computacionales  
Departamento de Programación — Campus Victor Levis Sasso  
**Curso:** Desarrollo de Software VII  
**Estudiante:** Victor Rivas  
**Semestre:** I Semestre 2026  

---

## 📋 Descripción

Este proyecto demuestra la implementación del estándar **PSR-4** para la organización de clases PHP mediante **Composer Autoload**, eliminando por completo el uso de `include` y `require` manuales y sustituyéndolos por una única llamada al autoloader generado por Composer.

---

## ⚙️ Guía de Instalación

### Requisitos previos
- PHP 8.0 o superior
- Composer instalado globalmente

### Pasos

**1. Clonar el repositorio**
```bash
git clone https://github.com/TU_USUARIO/autoload-psr4.git
cd autoload-psr4
```

**2. Generar el autoloader**
```bash
composer dump-autoload
```

> ⚠️ La carpeta `vendor/` está excluida del repositorio mediante `.gitignore`. Este comando la regenera localmente.

**3. Ejecutar el proyecto**
```bash
php index.php
```

---

## 📁 Estructura de Archivos

```
autoload-psr4/
├── src/
│   ├── Modelos/
│   │   ├── Usuario.php         → namespace App\Modelos
│   │   └── Producto.php        → namespace App\Modelos
│   └── Servicios/
│       └── Calculadora.php     → namespace App\Servicios
├── vendor/                     → generado por Composer (excluido del repo)
├── composer.json               → configuración PSR-4
├── index.php                   → punto de entrada
├── .gitignore
└── README.md
```

### Relación Namespace → Carpeta Física

| Namespace            | Carpeta física |
|---------------------|----------------|
| `App\`              | `src/`         |
| `App\Modelos`       | `src/Modelos/` |
| `App\Servicios`     | `src/Servicios/`|

---

## 🔧 Configuración PSR-4 en `composer.json`

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

El prefijo `App\\` mapea directamente a la carpeta `src/`. Composer genera automáticamente el archivo `vendor/autoload.php` con este mapa.

---

## 🧪 Pruebas de Ejecución

### Código en `index.php`
```php
require_once __DIR__ . '/vendor/autoload.php';

use App\Modelos\Usuario;
use App\Modelos\Producto;
use App\Servicios\Calculadora;

$usuario  = new Usuario("Victor", "victor@utp.ac.pa");
$producto = new Producto("Laptop", 850.00);
$calc     = new Calculadora();

echo $usuario->mostrarInfo() . PHP_EOL;
echo $producto->mostrarInfo() . PHP_EOL;
echo "Precio con 10% descuento: $" . number_format($calc->aplicarDescuento(850.00, 10), 2) . PHP_EOL;
```

### Resultado en terminal
```
Usuario: Victor | Correo: victor@utp.ac.pa
Producto: Laptop | Precio: $850.00
Precio con 10% descuento: $765.00
```

✅ Ningún error de "Class not found" — las clases son cargadas automáticamente por PSR-4.

---

## 📝 Conclusiones Técnicas

### 1. Mantenibilidad
Con PSR-4, agregar una nueva clase al proyecto es tan simple como crear el archivo PHP en la carpeta correcta con el namespace correspondiente. **No es necesario modificar ningún archivo de configuración global ni agregar nuevas líneas de `include`**. El autoloader de Composer detecta la clase automáticamente gracias al mapeo namespace → carpeta.

### 2. Eficiencia de Memoria (Lazy Loading)
El autoloader PSR-4 implementa carga bajo demanda (*lazy loading*): **una clase solo se carga en memoria en el momento exacto en que se instancia**, no al inicio de la aplicación. Esto reduce significativamente el consumo de memoria en proyectos grandes, ya que PHP no carga decenas de archivos de clases que tal vez nunca se usen en una petición determinada.

### 3. Estandarización y Trabajo Colaborativo
Seguir el estándar PSR-4 garantiza que cualquier desarrollador que se incorpore al proyecto pueda **predecir la ubicación de cualquier clase** con solo conocer su namespace. Esto elimina la ambigüedad, facilita el trabajo en equipo y hace que el proyecto sea compatible con herramientas del ecosistema PHP como Laravel, Symfony e IDEs como PhpStorm o VS Code, que reconocen PSR-4 de forma nativa.

---

## 🛡️ .gitignore

```
/vendor/
.DS_Store
*.log
```

La carpeta `vendor/` es excluida del repositorio para evitar subir miles de archivos generados. Cualquier colaborador puede regenerarla localmente con `composer dump-autoload`.

---

*Laboratorio realizado para el curso Desarrollo de Software VII — UTP 2026*
