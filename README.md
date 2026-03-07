# Sistema de Gestión Académica — CodeIgniter 4

Un CRUD completo para administrar estudiantes, docentes, materias, carreras y horarios, construido con CodeIgniter 4 y corriendo sobre XAMPP.

---

## ¿Qué hace este proyecto?

Básicamente es un sistema para manejar la información académica de una institución. Desde registrar alumnos hasta asignarle horarios a los docentes sin que se crucen, el sistema cubre los casos de uso más comunes de administración escolar.

### Módulos incluidos

- **Alumnos** — registro, edición y eliminación de estudiantes con su carrera asignada
- **Carreras** — catálogo de programas académicos
- **Docentes** — gestión del personal docente
- **Materias** — catálogo de materias disponibles
- **Horarios** — asignación de materias a docentes con validación de choques de horario (máx. 5 materias por docente)
- **Alumnos por materia** — consulta de qué alumnos están en cada materia
- **Alumnos por carrera** — consulta de alumnos agrupados por programa

---

## Tecnologías

| Herramienta | Para qué se usa |
|---|---|
| PHP 8.1+ | Lenguaje base |
| CodeIgniter 4 | Framework MVC |
| MySQL | Base de datos |
| Bootstrap 5 | Estilos y componentes UI |
| DataTables | Tablas interactivas con búsqueda y paginación |
| XAMPP | Entorno local de desarrollo |
| Composer | Manejo de dependencias PHP |

---

## Instalación local

**Requisitos:** XAMPP (Apache + MySQL), PHP 8.1 o superior, Composer.

```bash
# 1. Clonar el repositorio dentro de htdocs
git clone <url-del-repo> C:/xampp/htdocs/crud-estudiantes-codeigniter4

# 2. Instalar dependencias
composer install

# 3. Configurar el entorno
cp env .env
```

En el archivo `.env`, ajustá la conexión a la base de datos:

```
database.default.hostname = localhost
database.default.database = nombre_de_tu_bd
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

Luego importá el SQL de la base de datos desde phpMyAdmin o la línea de comandos, y accedé desde:

```
http://localhost/crud-estudiantes-codeigniter4/public
```

---

## Estructura del proyecto

```
app/
├── Controllers/      # Lógica de cada módulo (Alumnos, Docentes, Horarios, etc.)
├── Models/           # Modelos con reglas de validación y queries
└── Views/
    ├── layouts/      # Layout principal compartido
    ├── alumnos/
    ├── carreras/
    ├── docentes/
    ├── materias/
    ├── horarios/
    └── alumnosxmateria/
```

---

## Algunas decisiones de implementación

- La validación de choques de horario se hace en el controller antes de insertar, comparando día y rangos de hora contra los horarios ya registrados del docente.
- Los formularios de horarios son dinámicos: se pueden agregar múltiples materias en una sola inscripción.
- Las eliminaciones usan POST en lugar de DELETE para mayor compatibilidad con formularios HTML sin JavaScript extra.
- Se usa `left join` en la consulta de alumnos para mostrarlos aunque no tengan carrera asignada.

---

## Autor

Hecho por **Wilmer Henrry Salazar Martinez** — gracias por tomarte el tiempo de revisar este proyecto.

---

> Proyecto académico desarrollado con CodeIgniter 4. Libre de usar o adaptar.
