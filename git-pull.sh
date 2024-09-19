composer2 install --optimize-autoloader --no-dev
ln -s ../storage/app/public public/storage
npm run build
php artisan optimize:clear
