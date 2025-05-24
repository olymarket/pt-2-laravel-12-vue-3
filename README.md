# Agenda

This project is a technical test that consists of developing an agenda with the following features:
- Database: SQLite.
- Backend: API built with Laravel 12.
- Frontend: Developed with Vue.js, consuming the API via Axios.

---

## Demo

![Portfolio Demo](./img/demo.webp "Desktop Demo")
Link: pt2.olymarket.online
---

## 🔧 Requirements

- Laravel = 12
- PHP   = 8.4
- VUE   = 3
- MySQL = 9.3.0

---

## ⚙️ Installing

```bash
git clone https://github.com/olymarket/pt-2-laravel-12-vue-3.git # Clona el repositorio
cd pt-2-laravel-12-vue-3                                         # Ingresa dentro del repositirio
composer install                                                 # Instala composer
npm install                                                      # Instala node
cp .env.example .env                                             # genera el archivo .env
php artisan key:generate                                         # genera la clave secreta
php artisan migrate                                              # genera la migracion de tablas
php artisan migrate --seed                                       #Genera los datos falsos