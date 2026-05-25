# Sistema de Control de Inventario

Aplicación web desarrollada con Laravel para la gestión de inventario de material en una empresa.  
El sistema permite consultar artículos, clasificarlos por categorías, controlar su stock y diferenciar permisos entre usuarios empleados y administradores.

Este proyecto forma parte del desarrollo del proyecto final del ciclo de Desarrollo de Aplicaciones Web.

---

## Estado del proyecto

El proyecto se encuentra actualmente en fase de desarrollo.

Funcionalidades implementadas hasta el momento:

- Instalación y configuración inicial de Laravel.
- Configuración de base de datos MariaDB.
- Autenticación de usuarios mediante Laravel Breeze.
- Personalización visual de las vistas de autenticación.
- Sistema básico de roles: administrador y empleado.
- Migraciones principales del modelo de inventario.
- Modelos Eloquent y relaciones entre entidades.
- Seeders con datos iniciales de prueba.
- Listado de artículos.
- Vista de detalle de artículo.
- Creación de artículos desde el panel de administración.
- Edición de artículos desde el panel de administración.

---

## Tecnologías utilizadas

- PHP 8.3
- Laravel 13
- MariaDB
- Blade
- Tailwind CSS
- Vite
- Composer
- npm
- Git y GitHub
- WSL2 con Ubuntu
- Visual Studio Code

---

## Funcionalidades principales previstas

El sistema contempla las siguientes funcionalidades:

- Autenticación de usuarios.
- Diferenciación de roles:
  - Empleado: consulta del inventario.
  - Administrador: gestión de artículos y stock.
- CRUD de artículos.
- Clasificación de artículos por categorías:
  - Informática
  - Limpieza
  - Oficina
- Cálculo automático del estado del artículo:
  - Disponible
  - Bajo stock
  - Agotado
- Registro de movimientos de stock.
- Historial de entradas y salidas.
- Panel de control con indicadores básicos.
- API REST de consulta.

---

## Modelo de datos principal

El modelo de datos se organiza en las siguientes entidades:

- `users`: usuarios del sistema y rol asignado.
- `categories`: categorías de artículos.
- `items`: artículos del inventario.
- `stock_movements`: movimientos de entrada y salida de stock.

El estado de cada artículo no se almacena directamente en la base de datos, sino que se calcula dinámicamente a partir del stock actual y el stock mínimo.

---

## Instalación del proyecto en local

Clonar el repositorio:

```bash
git clone https://github.com/EnriqueNieto90/ENLAplicacionGestorInventario.git
```

Entrar en la carpeta del proyecto:

```bash
cd ENLAplicacionGestorInventario
```

Instalar dependencias PHP:

```bash
composer install
```

Instalar dependencias frontend:

```bash
npm install
```

Copiar el archivo de entorno:

```bash
cp .env.example .env
```

Generar la clave de aplicación:

```bash
php artisan key:generate
```

Configurar la conexión a la base de datos en el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventario
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

Ejecutar migraciones y seeders:

```bash
php artisan migrate:fresh --seed
```

Compilar los assets:

```bash
npm run build
```

Arrancar el servidor de desarrollo:

```bash
php artisan serve
```

La aplicación estará disponible en:

```text
http://localhost:8000
```

---

## Usuarios de prueba

El sistema incluye usuarios iniciales generados mediante seeders.

### Administrador

```text
Email: admin@inventario.test
Contraseña: password
```

### Empleado

```text
Email: empleado@inventario.test
Contraseña: password
```

El usuario administrador puede gestionar artículos y stock.  
El usuario empleado puede consultar el inventario, pero no realizar acciones de gestión.

---

## Flujo básico de uso

1. El usuario inicia sesión.
2. Accede al panel de control.
3. Consulta el listado de artículos.
4. Puede ver el detalle de cada artículo.
5. Si es administrador, puede crear y editar artículos.
6. El control de stock se realizará mediante movimientos de entrada y salida.

---

## Decisiones técnicas destacadas

- Uso de Laravel Breeze como base para la autenticación.
- Personalización de las vistas generadas por Breeze.
- Uso de Eloquent ORM para la gestión de modelos y relaciones.
- Uso de migraciones para versionar la estructura de la base de datos.
- Uso de seeders para generar datos iniciales de prueba.
- Separación entre autenticación y autorización mediante roles.
- Estado de los artículos calculado dinámicamente para evitar inconsistencias.
- Baja lógica de artículos mediante el campo `is_active`.
- Registro previsto de movimientos de stock para mantener trazabilidad.

---

## Ramas del repositorio

- `master`: rama principal estable.
- `ENLdeveloper`: rama de desarrollo utilizada durante la implementación.

---

## Autor

**Enrique Nieto Lorenzo**  
Proyecto final de Desarrollo de Aplicaciones Web  
IES Los Sauces - Benavente
