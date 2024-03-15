# BRUTAL THOUGHTS

Генератор случайных цитат в стиле нео-брутализм. Плакатный дизайн, кислотные цвета, толстые бордеры.

## Стек

- Laravel 11 / PHP 8.3
- Tailwind CSS v4
- Alpine.js
- html2canvas

## Установка

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
```

## Запуск

```bash
php artisan serve
```

## Фичи

- **Случайная цитата** — без повторов в рамках сессии
- **Neo-brutalism UI** — толстые бордеры, плоские тени, кислотные цвета
- **Анимации** — плавающие фигуры, бегущая строка, bounce-in при смене цитаты
- **Скачать как PNG** — html2canvas, scale 4x
- **Feature-тесты** — проверка логики сессии и отсутствия повторов

## Тесты

```bash
php artisan test
```

## Деплой на Fly.io

```bash
fly launch --no-deploy
fly deploy
```

После первого деплоя выполни миграции и сиды:

```bash
fly ssh console --command "php artisan migrate --seed"
```
