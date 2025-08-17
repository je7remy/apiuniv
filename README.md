# 🏫 ApiUniv - API REST para gestión universitaria

**ApiUniv** es una API REST desarrollada en **PHP** que sirve como backend para la aplicación móvil [AppUniv](https://github.com/tuusuario/appuniv).  
Este servicio proporciona endpoints para la gestión de estudiantes, maestros, materias, usuarios y periodos académicos. Además, implementa un sistema de **autenticación mediante JWT** para mayor seguridad.

---

## 🚀 Características principales
- 🔑 Autenticación segura con **JWT (JSON Web Tokens)**
- 👨‍🎓 Gestión de estudiantes y maestros
- 📚 Administración de materias y asignaciones
- 📅 Control de periodos académicos
- 📝 Registro y autenticación de usuarios
- 💾 Script SQL incluido para base de datos inicial

---

## 📁 Estructura del proyecto

config/                -> Configuración de conexión y utilidades
estudiantes/           -> Endpoints CRUD de estudiantes
maestros/              -> Endpoints CRUD de maestros
materias/              -> Endpoints CRUD de materias
materiaxestudiante/    -> Relación materia-estudiante
materiaxmaestro/       -> Relación materia-maestro
periodos\_academicos/   -> Gestión de periodos académicos
usuario/               -> Gestión de usuarios
login/                 -> Autenticación con JWT
log/                   -> Registros de actividad
libs/php-jwt-master/   -> Librería JWT incluida
index.php              -> Punto de entrada principal
instituto.sql          -> Script de base de datos



---

## 🛠️ Tecnologías utilizadas
- **PHP 7.4+**
- **MySQL/MariaDB**
- **JWT** (librería incluida en `libs/php-jwt-master`)

---

## 📦 Instalación y configuración

1. Clona el repositorio:
   ```bash
   git clone https://github.com/tuusuario/apiuniv.git
``

2. Configura la base de datos importando el archivo:

   ```sql
   instituto.sql
   ```
3. Ajusta las credenciales de conexión en `config/database.php` (si aplica).
4. Ejecuta el servidor local de PHP:

   ```bash
   php -S localhost:8000
   ```
5. Los endpoints estarán disponibles en:

   ```
   http://localhost:8000
   ```

---

## 🔑 Ejemplo de autenticación

1. **Login** (POST `/login`)
   Envía credenciales y recibe un **token JWT**.
2. **Acceso a recursos protegidos**
   Incluye el token en el header:

   ```
   Authorization: Bearer <tu_token>
   ```

---

## 📌 Próximas mejoras

* Validaciones avanzadas en formularios
* Middleware para control de permisos
* Documentación en Swagger/OpenAPI
* Dockerización del proyecto

---

## 👨‍💻 Autor

Desarrollado por **Jeremy José de la Cruz Pérez (je7remy)**
Estudiante de **Licenciatura en Informática** en la **Universidad Pedro Henríquez Ureña**.

---

## 📜 Licencia

Este proyecto es de uso libre bajo la licencia MIT.


