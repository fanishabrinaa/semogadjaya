#!/bin/sh
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan serve --host=0.0.0.0 --port=${PORT:-10000}