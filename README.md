# ICAM Memory — Plataforma de Gestión de Memorias Técnicas

Sistema web interno para la generación, almacenamiento y descarga de **memorias técnicas** en formato Word, desarrollado para **ICAM SL**. Incluye además un calculador de cumplimiento de normativa de protección contra incendios (PCI) según el reglamento RSCIEI español.

---

## Características principales

- **Memorias de Compatibilidad**: Generación de informes de compatibilidad urbanística con descarga en `.docx` vía PHPWord
- **Memorias de Grupo Electrógeno**: Generación de memorias técnicas IEBT-GE a partir de una plantilla Word con sustitución de tokens, lectura automática de presupuesto desde Excel y autocompletado geográfico vía GeoNames API
- **PCI Manager**: Calculador de requisitos de protección contra incendios industriales (RSCIEI), con resultados acumulativos por tipo, superficie y nivel de riesgo
- **Historial de memorias**: Vista de todas las memorias generadas con acceso a ver, editar y descargar
- **Autenticación**: Sistema de login con sesiones, sin registro público (usuarios creados manualmente o por seeder)
- **Soporte de temas**: Modo claro/oscuro persistido en `localStorage`

---

## Stack tecnológico

| Capa | Tecnología |
|---|---|
| Framework | Laravel 12 (PHP 8.2+) |
| Base de datos | MySQL |
| Frontend | Bootstrap 5.3 (CDN), Bootstrap Icons |
| Build tooling | Vite 6 + TailwindCSS 4 (instalado, pendiente de uso) |
| Generación Word | PHPWord ^1.3 (directo y por plantilla) |
| Lectura Excel | PHPSpreadsheet ^4.1 |
| PDF | barryvdh/laravel-dompdf ^3.1 (instalado, pendiente de uso) |
| JS (UI) | CKEditor 4, Animate.css, Vanta.js |
| API externa | GeoNames API (autocompletado de municipios por CP) |
| Hosting | Plesk |

---

## Arquitectura de base de datos

### Tablas y campos

```
users
├── id (PK)
├── name
├── email (unique)
├── password (hashed)
├── rol: enum('user','admin')  [default: 'user']
└── timestamps

forms  (Memorias de Compatibilidad)
├── id (PK)
├── name, cover (nullable)
├── holder, address, cod_address, cif
├── name_agent, nif
├── location, cod_location
├── activity, description, requirements
├── m_parcels decimal(8,2), m_surface decimal(8,2)
└── timestamps

group_electros  (Memorias de Grupo Electrógeno)
├── id (PK)
├── name, author
├── budget_excel (ruta .xlsx), cover (nullable)
├── holder, address, cod_address, local_address, town_address, cif
├── name_agent, nif
├── location, cod_location, name_location, name_town
├── build, kva decimal(8,2), kw decimal(8,2)
├── tension_type, budget decimal(12,2), type_clasi
├── mark, model, voltage
├── image_model, image_dimensions (rutas de imagen)
├── air_entry, air_flow, w decimal(8,2), factor decimal(5,2)
├── method (text)
└── timestamps

low_voltages  (STUB — solo id + timestamps, pendiente de implementación)

-- Tablas de framework --
password_reset_tokens, sessions, cache, cache_locks,
jobs, job_batches, failed_jobs
```

### Relaciones
El proyecto no define relaciones Eloquent entre tablas. Cada tipo de memoria (`forms`, `group_electros`) es independiente. Los usuarios no están asociados a memorias (la autoría solo se registra en el campo `author` del grupo electrógeno como valor textual).

---

## Instalación

### Requisitos previos

- PHP 8.2+
- Composer
- Node.js 18+ y npm
- MySQL 8.0+
- Extensiones PHP: `fileinfo`, `zip`, `gd`, `mbstring`, `xml`

### Pasos

```bash
# 1. Clonar el repositorio
git clone <url-del-repositorio> icam-memory
cd icam-memory

# 2. Instalar dependencias PHP
composer install

# 3. Instalar dependencias frontend
npm install

# 4. Configurar el entorno
cp .env.example .env
php artisan key:generate

# 5. Configurar base de datos en .env
# DB_DATABASE=icam_memory
# DB_USERNAME=tu_usuario
# DB_PASSWORD=tu_contraseña

# 6. Ejecutar migraciones y seeders
php artisan migrate --seed

# 7. Crear enlace de almacenamiento
php artisan storage:link

# 8. Compilar assets
npm run build
# o en desarrollo:
npm run dev
```

### Plantilla Word (obligatorio para Grupo Electrógeno)

Copiar la plantilla `.docx` en la ruta esperada:

```
storage/app/private/plantillas/memoria_IEBT-GE_2032-modif-copia.docx
```

> Sin este archivo, la descarga de memorias de grupo electrógeno fallará con un error de fichero no encontrado.

### Credenciales por defecto (seeder)

| Campo | Valor |
|---|---|
| Email | `admin@icam.com` |
| Contraseña | `password` |
| Rol | `admin` |

> **Cambiar la contraseña en producción antes del primer uso.**

---

## Estructura del proyecto

```
icam-memory/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── LoginController.php
│   │   │   ├── FormController.php          # Memorias de Compatibilidad (CRUD + .docx)
│   │   │   ├── GroupElectroController.php  # Memorias de Grupo Electrógeno (CRUD + plantilla .docx + Excel)
│   │   │   ├── LowVoltageController.php    # Stub (Próximamente)
│   │   │   └── PciController.php           # Calculador PCI (AJAX)
│   │   └── Requests/                       # Form Requests con validación y mensajes en español
│   ├── Models/
│   │   ├── User.php
│   │   ├── Form.php
│   │   ├── groupElectro.php
│   │   └── LowVoltage.php
│   └── Services/
│       └── PciCalculatorService.php        # Lógica de cálculo RSCIEI
├── database/
│   ├── migrations/
│   ├── factories/UserFactory.php
│   └── seeders/DatabaseSeeder.php
├── public/
│   └── js/
│       ├── compatibility.js    # Global: tema, validación en tiempo real, carousel
│       ├── groupElectro.js     # Autocompletado geográfico por código postal
│       └── pci.js              # AJAX submit + tabla dinámica de resultados
├── resources/
│   ├── fonts/                  # Fuentes Leelawadee para generación .docx
│   └── views/
│       ├── layout.blade.php    # Master layout (Bootstrap 5.3, CKEditor, tema)
│       ├── partials/           # header, nav, footer
│       ├── form/               # Historial e índice de memorias
│       │   ├── compatibility/  # CRUD vistas de Compatibilidad
│       │   ├── groupElectro/   # CRUD vistas de Grupo Electrógeno
│       │   └── lowVoltage/     # Stub
│       └── pci/index.blade.php
└── routes/web.php
```

---

## Flujo de uso

### Generar una Memoria de Compatibilidad
1. Navegar a **Crear Memoria → Compatibilidad**
2. Rellenar el formulario (titular, emplazamiento, actividad, superficies)
3. Guardar → ver en historial
4. En la vista de detalle, pulsar **Descargar en Word** → genera y descarga `.docx`

### Generar una Memoria de Grupo Electrógeno
1. Navegar a **Crear Memoria → Grupo Electrógeno**
2. Seleccionar autor, subir presupuesto Excel (`.xlsx`)
3. Introducir código postal — los campos de municipio y localidad se autocompletan vía GeoNames API
4. Rellenar datos técnicos (kVA, kW, tensión, clasificación, marca, modelo, etc.)
5. Subir imágenes del modelo y dimensiones
6. Guardar → descargar `.docx` generado a partir de la plantilla corporativa

### Calcular PCI
1. Navegar a **PCI Manager**
2. Introducir: nombre, tipo (Av/Ah/B/C/D), superficie (m²), uso (almacenamiento/producción), nivel de riesgo (1-8), situación (rasante/sótano)
3. Los resultados se acumulan en tabla dinámica; cada fila es un escenario calculado independiente

---

## Variables de entorno clave

```env
APP_NAME="ICAM Memory"
APP_ENV=production
APP_DEBUG=false
APP_LOCALE=es

DB_CONNECTION=mysql
DB_DATABASE=icam_memory
DB_USERNAME=
DB_PASSWORD=

SESSION_DRIVER=file
FILESYSTEM_DISK=local
```

> El usuario de GeoNames API está actualmente hardcodeado en `GroupElectroController`. Para moverlo a `.env`, añadir `GEONAMES_USERNAME=` y actualizar el controlador.

---

## Despliegue en Plesk

1. Apuntar el Document Root a `public/`
2. Configurar PHP 8.2+ en el dominio
3. Crear la base de datos MySQL y configurar `.env`
4. Ejecutar via SSH:
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan migrate --seed
   php artisan storage:link
   npm ci && npm run build
   ```
5. Subir manualmente la plantilla Word a `storage/app/private/plantillas/`
6. Asegurar permisos de escritura en `storage/` y `bootstrap/cache/`

---

## Issues conocidos y pendientes

| # | Severidad | Descripción |
|---|---|---|
| 1 | **Crítico** | `lowVoltageController::class` en `web.php` usa minúscula — falla en Linux (filesystem case-sensitive) |
| 2 | **Bug** | Vista `lowVoltage/create.blade.php` hace submit a `form.store` en lugar de `lowVoltage.store` |
| 3 | **Bug** | Vista `groupElectro/edit.blade.php`: select de `type_clasi` tiene opciones incompletas/incorrectas |
| 4 | **Bug** | Vista `groupElectro/edit.blade.php`: input de `budget_excel` tiene atributo mal nombrado |
| 5 | **Deprecación** | `strftime()` en `FormController` está deprecado en PHP 8.1+ y eliminado en PHP 9 |
| 6 | **Incompleto** | Migración `low_voltages` solo tiene `id` + timestamps; modelo define 15 campos sin columnas |
| 7 | **Seguridad** | Username de GeoNames hardcodeado en el controlador — debería estar en `.env` |
| 8 | **Sin auth** | Ruta `/pci` no tiene middleware `auth` — accessible sin login |
| 9 | **Naming** | Archivo `groupElectro.php` no sigue PSR-4 (debería ser `GroupElectro.php`) |
| 10 | **Campo huérfano** | Campo `fecha` en fillable de `GroupElectro` no existe en la migración |
| 11 | **Sin versionar** | Plantilla Word no está en el repositorio — dependencia externa sin gestión |
| 12 | **Sin usar** | `barryvdh/laravel-dompdf` y TailwindCSS instalados pero sin uso activo |
| 13 | **Próximamente** | Módulo Baja Tensión deshabilitado en interfaz y sin implementación backend |

---

## Desarrollo local

```bash
# Servidor de desarrollo
php artisan serve

# Assets en modo watch
npm run dev

# Tinker (REPL)
php artisan tinker

# Limpiar caché
php artisan optimize:clear
```

---

## Licencia

Proyecto privado — ICAM SL. Todos los derechos reservados.

---

*Desarrollado por Marlon Torres*
