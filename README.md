<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel
Antes de rodar o projeto, verifique se você tem as seguintes dependências instaladas:

- **PHP**: 8.x ou superior
- **Composer**: 2.x ou superior
- **Node.js**: 16.x ou superior (se o projeto usar recursos frontend)
- **NPM** ou **Yarn** (para dependências frontend)

### Dependências do Projeto

Este projeto utiliza o **Laravel 10** com as seguintes bibliotecas e dependências:

- **Livewire**: Para criação de componentes dinâmicos no frontend.
- Outras dependências específicas para seu projeto (todas registradas no `composer.json` e `package.json`).

## Instalação

### 1. Clonar o repositório

Clone este repositório para o seu ambiente local:

```bash
git clone git@github.com:AlbertoGabrielDev/App-facilita.git
cd seu-projeto

composer install

npm install
# ou, caso utilize Yarn:
yarn install

cp .env.example .env
php artisan key:generate

php artisan migrate

php artisan serve

