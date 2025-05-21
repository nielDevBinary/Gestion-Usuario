# Proyecto Laravel - Gestión de Usuarios

Este proyecto es una aplicación Laravel que gestiona usuarios, perfiles e historial de inicios de sesión.

## 🚀 Requisitos

- PHP 8.2
- Composer
- MySQL
- Node.js
- Laravel 12

## ⚙️ Instalación

1. **Clona el repositorio**
```bash
git clone https://github.com/tu-usuario/tu-repo.git
cd tu-repo 
```

2. **Ejecutar las migraciones**
```bash
php artisan migrate
```

3. **Ejecucion de carga masiva de datos**
```bash
# Ejecuta la creación masiva de usuarios y perfiles.
php artisan db:seed
```
```bash
# Ejecuta la creación masiva registros ficticios de LoginHistory asociados a usuarios 
php artisan generate:login-histories
```
4. **Ejecucion de cola de correos**
```bash
# Ejecuta 500 usuarios aleatorios y se encola
php artisan usuarios:encolar-notificaciones
```
```bash
# entrega de correos
php artisan queue:work
```
