# Laravel + Vue 3 + Axios Setup Guide

Este proyecto utiliza Laravel como backend y Vue 3 como frontend con Axios para el consumo de API.

---

## 🔧 Requisitos previos

Asegúrate de tener instalado:

- PHP = 8.4
- Composer = 2.8.9
- Node.js >= 18.20.8
- MySQL = 9.3.0

---

## ⚙️ Instalación del proyecto

```bash
git clone https://github.com/olymarket/pt-2-laravel-12-vue-3.git # Clona el repositorio
cd pt-2-laravel-12-vue-3                                         # Ingresa dentro del repositirio
composer install                                                 # Instala composer
npm install                                                      # Instala node
cp .env.example .env                                             # genera el archivo .env
php artisan key:generate                                         # genera la clave secreta
php artisan migrate                                              # genera la migracion de tablas
php artisan migrate --seed                                       #Genera los datos falsos