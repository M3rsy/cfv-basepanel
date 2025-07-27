# 🌐 cfv-basepanel

**cfv-basepanel** es un panel administrativo base construido con Laravel 12 y Filament v3, diseñado por CFV Technology para acelerar el desarrollo de sistemas administrativos modernos y escalables.

---

## 🚀 Características Iniciales

- Laravel 12 + Filament v3
- Compatible con MySQL o PostgreSQL
- Autenticación integrada con Filament
- CRUD completo de usuarios
- Soporte para entornos Herd

---

## 🔧 Requisitos

- PHP 8.2+
- [Laravel Herd](https://herd.laravel.com/) en macOS
- Composer
- MySQL o PostgreSQL
- Node.js (si deseas compilar assets personalizados)

---

## ⚙️ Instalación del Proyecto

### 1. Clonar el repositorio

```bash
git clone https://github.com/tuusuario/cfv-basepanel.git
cd cfv-basepanel
```

### 2. Instalar dependencias y configurar entorno

```bash
composer install
cp .env.example .env
php artisan key:generate
```

### 3. Configurar base de datos en `.env`

#### Ejemplo para MySQL
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cfv_basepanel
DB_USERNAME=root
DB_PASSWORD=
```

#### Ejemplo para PostgreSQL
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=cfv_basepanel
DB_USERNAME=postgres
DB_PASSWORD=
```

Crea la base de datos con tu gestor favorito.

---

## 🧱 Configuración Final

### 4. Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```

### 5. Crear storage link (necesario para logos y archivos)

```bash
php artisan storage:link
```

### 6. Limpiar cache para evitar problemas

```bash
php artisan optimize:clear
php artisan filament:clear
```
---

### 6. Acceder al panel Administrativo

```url
http://cfv-basepanel.test/admin
```

---

## ✅ Próximos pasos sugeridos
- Dashboard personalizado
---

## 🧠 Créditos

Desarrollado con ❤️ por CFV Technology  
**Exploramos. Innovamos. Transformamos.**

---

## 📜 Licencia

Este proyecto está bajo la licencia MIT.
